<?php

namespace backend\controllers;

use backend\models\EmailQueue;
use backend\models\Sayygo;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\bootstrap\Alert;
use yii\log\Logger;


class CommunicationController extends \yii\web\Controller {
	public function behaviors() {
		return [
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'post' ],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow'   => true,
						'actions' => [ 'view' ],
						'roles'   => [ '?' ],
					],
					[
						'allow'   => true,
						'actions' => [
							'create',
							'index',
							'delete',
							'admin',
						],
						'roles'   => [ '@' ],
					],
				],
			],

		];
	}

	public function actionAdmin() {
		return $this->render( 'admin' );
	}

	/**
	 * @return string
	 * Create a message from person A to person B relating to a sayygo
	 * Render views create
	 * Upon save, create en email queue of type 'email_message'
	 */
	public function actionCreate( $fromuserid,$touserid,$sayygoid,$emailqueueid ) {
		$params           = \yii::$app->getRequest()->queryParams;
		if (!empty($params['emailqueueid'])){
			$params['body'] = EmailQueue::findOne($params['emailqueueid'])->body;
		}
		$params['toUser'] = User::findOne( $touserid );
		$params['sayygo'] = Sayygo::findOne( $sayygoid );

		if ( $message = Yii::$app->request->post() ) {
			//create email queue
			$emailQ          = new EmailQueue();
			$emailQ->setAttributes(['type'=>"message", 'from_user_id'=>$fromuserid, 'status'=>'queueing', 'dday'=> \yii::$app->formatter->asDatetime('now','Y-MM-dd H:i:s'),
			                       'to_user_id'=>$touserid, 'body'=>nl2br($message['body']), 'subject'=>$message['subject']]);

			if ($emailQ->save()){
			Yii::$app->session->setFlash( 'sendmailqueued',[
				'type'     => 'success',
				'title'    => 'Success!',
				'duration' => 5000,
				'icon'     => 'fa fa-users',
				'message'  => 'Your message has been sent!',
			] );
			} else {
				Yii::error("Failed to save model". json_encode($emailQ->errors));
				Yii::$app->session->setFlash( 'sendmailqueuefailed',[
					'type'     => 'fail',
					'title'    => 'Error!',
					'duration' => 5000,
					'icon'     => 'fa fa-users',
					'message'  => 'Message can not be sent! Please try again or contact us at support@sayygo.com',
				] );
			}

			return $this->redirect( "/f/web" );
		} else {

			return $this->render( 'create',
			                      $params
			);
		}
	}

	public function actionDelete() {
		return $this->render( 'delete' );
	}

	public function actionIndex() {
		return $this->render( 'index' );
	}

	public function actionView() {
		return $this->render( 'index' );
	}

}
