<?php
namespace console\controllers;

use backend\controllers\EmailQueueController;
use backend\controllers\SayygoController;
use backend\models\EmailLog;
use backend\models\EmailQueue;
use backend\models\Sayygo;
use common\models\User;
use yii\console\Controller;
use yii\db\Query;
use yii\db\QueryBuilder;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Url;


/**
 * Matching controller - process matches, send emails, etc...
 */
class MatchController extends Controller {

	public function actionMatchall() {
		echo date( "Y-m-d H:i:s" ) . " Match populating...\n";
		$result = SayygoController::actionMatchall();
		print_r( $result );
		echo "Match populating ends.//\n";
	}

	public function actionPurge() {
		echo "Match purging";
	}

	/*
	 * Sweeping through all matches and queue all emails
	 */
	public function actionSweep() {
		//scans for matches

		//scans for users waiting for immediate email

	}

	/*
	 * Case: a single sayygo is created
	 * Action: scan through the rest of sayygo matching its keywords
	 * Notify owners waiting for immediate email (put email onto queue)
	 *
	 */
	public function actionUpdatesinglesayygo( $sg ) {
		$result = [ ];
		if ( is_int( intval( $sg ) ) ) {
			$sg = Sayygo::findOne( $sg );
			/** @var \backend\models\sayygo $sg */
		}
		$sgs = $sg->getSayygosShareKeywordGroupByUser();
		foreach ( $sgs as $sgShareKw ) {
			$notFreq = $sgShareKw->notification_frequency;
			if ( in_array( $notFreq,[ 'Instant Email','Instant Email and SMS' ] ) ) {
				$emailQ                         = new EmailQueue();
				$emailQ->to_user_id                = $sgShareKw->user_id;
				$emailQ->type                   = "match";
				$emailQ->matching_sayygos       = json_encode( $sg->getAttributes() );
				$emailQ->notification_frequency = "immediate";
				$emailQ->dday                   = \yii::$app->formatter->asDatetime( 'now','y-MM-d H:m:s' );
				$emailQ->status                 = 'queueing';

				if ( $emailQ->save() ) {
					$result[] = [
						'status'   => 'success',
						'user_id'  => $sgShareKw->user_id,
						'username' => $sgShareKw->user->username
					];
				} else {
					$result[] = [
						'status'  => 'error',
						'user_id' => $sgShareKw->user_id,
						'message' => 'Error while saving email queue'
					];
				}

			}
		}
		echo json_encode( $result );
	}


	/**
	 * Process email
	 * Looks up the email queue and send email based on its type
	 * Logs sent email or error sending email into email_log
	 */
	public function actionProcessemail() {
		$numOfEmailProcessed = 0;
		$processes           = [ ];
		//get all mail queued and having dday one hour ago until now
		$query  = ( new Query() )->select( '*' )->from( 'email_queue' )->where( [
			                                                                        '>=',
			                                                                        'dday',
			                                                                        date( 'Y-m-d H:m:s',
			                                                                              strtotime( '1 hour ago' ) )
		                                                                        ] )->andWhere(['status'=>'queueing']);
		$emails = $query->all();

		//foreach email
		foreach ( $emails as $email ) {
			/** @var array() $email */

			$body     = "";
			$users    = [ ];
			$bccUsers = [ ];
			$subject  = "We found new matching sayygos for you";
			if ( ( $email['type'] === 'match' ) && ( $email['notification_frequency'] === "immediate" ) ) {
				//get list of sayygos
				$matchingSg = json_decode( $email['matching_sayygos'] );
				/** @var \backend\models\sayygo $matchingSg */
				$targetUser = User::findOne( $email['to_user_id']);
				$users[]    = $targetUser;
				/** @var \common\models\user $targetUser */
				$username = $targetUser->getFullName();
				$body     = "There is one new sayygo matching your destination: <br/> <br/> ";
				$body .= "<i>$matchingSg->full_text</i>";
				$body .= "<br/> <br/>This sayygo was created by <i>$username</i> on " . Yii::$app->formatter->asDate( $matchingSg->created_at,
				                                                                                                      'EEEE, MMMM d, yyyy h:mm a, z' ) . " and is expected to start on " . ( empty( $matchingSg->start_date ) ? ' whenever' : $matchingSg->start_date );
				$body .= ", ending on " . ( empty( $matchingSg->end_date ) ? ' whenever' : $matchingSg->end_date );
				$body .= ".<br/> The partner's sex preference " . ( empty( $matchingSg->partner_sex ) ? ' doesn\'t matter' : ( "is " . $matchingSg->partner_sex ) );
				$body .= "; partners should have experience as: " . ( empty( $matchingSg->partner_experience ) ? ' whatever' : $matchingSg->partner_experience ) . ", preferably " . $matchingSg->partner_num_preference . " partners.";
				if ( ! empty( $matchingSg->num_of_partner ) ) {
					$body .= "<br/> Ideal number of partners is " . $matchingSg->num_of_partner . " partners.";
				}
				$body .= "<br/><br/> Please view more details at: " . BaseUrl::to( [
					                                                                   'b/web/sayygo',
					                                                                   'id' => $matchingSg->id
				                                                                   ] );
				$subject = "We found a new matching sayygo for you that was created on " . Yii::$app->formatter->asDate( $matchingSg->created_at,
				                                                                                                         'EEEE, MMMM d, yyyy h:mm a, z' );
			} elseif ( $email['type'] === 'message' ) {
				$users[] = User::findOne( $email['to_user_id'] );
				if ( $email['send_copy'] ) {
					$bccUsers[] = User::findOne( $email['from_user_id'] );
				}
				$subject = "You have a new message from " . User::findOne( $email['from_user_id'] )->getFullName() . ", " . $email['subject'];
				$body    = $email['body'];
				$body .= "<br/>To reply to this user, please click here:" . Url::to( '@absoluteBaseUrl/b/web/communication/create/' . $email['to_user_id'] . '/' . $email['from_user_id'] . '/null/' . $email['id'] );

			}
			//send them to user's email
			$to = "";
			$to = \usv\yii2helper\PHPHelper::imp( ",",array_reduce( $users,function ( $carry,$item ) {
				$carry[] = $item->email;

				return $carry;
			} ) );

			//send them to bcc user's email
			$bccTo = "";
			$bccTo = \usv\yii2helper\PHPHelper::imp( ",",array_reduce( array_filter( $bccUsers ),
				function ( $carry,$item ) {
					$carry[] = $item->email;

					return $carry;
				} ) );

			//set subject, set recipient, set body
			//send
			//get status of sending
			$emailQueueItem = EmailQueue::findOne( $email['id'] );
			/** @var \backend\models\emailQueue $emailQueueItem */
			$emailLog = new EmailLog();
			$emailLog->setAttributes( [
				                          'email_queue_id' => $emailQueueItem->id,
				                          'old_status'     => $emailQueueItem->status
			                          ] );
			$mailer = Yii::$app->mailer->compose()
			                           ->setFrom( Yii::$app->params['adminEmail'] )
			                           ->setTo( $to )
			                           ->setSubject( $subject )
			                           ->setHtmlBody( $body,'html' );
			if ( ! empty( $bccTo ) ) {
				$mailer->setBcc( $bccTo );
			}

			if ( $mailer->send() ) {

				//if successful, clears email from queue
				$emailQueueItem->setAttributes( [ 'status' => 'sent','dday' => null ] );
				$emailQueueItem->save();
				$emailLog->setAttributes( [
					                          'current_status' => 'sent'
				                          ] );
			} else {
				//else change status to queueing, set dday for tomorrow
				$emailQueueItem->dday = date( 'Y-m-d H:m:s',strtotime( '+1 day' ) );
				$emailQueueItem->save();
				$emailLog->setAttributes( [
					                          'current_status' => 'email failed'
				                          ] );
			}
			//log status into email log
			$emailLog->save();
		}

		return compact( $numOfEmailProcessed,$processes );
	}

	public function  actionTest() {
//		$result = SayygoController::actionUpdate;
//		print_r( $result );
//		echo "Testing ends.//\n";

	}

}
