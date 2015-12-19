<?php
namespace common\models;

use dektrium\user\models\User as BaseUser;
use dektrium\user\Finder;
use dektrium\user\helpers\Password;
use dektrium\user\Mailer;
use dektrium\user\Module;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\log\Logger;
use yii\web\IdentityInterface;
use dektrium\user\models\Token;


class User extends BaseUser {

	/**
	 * This method attempts user confirmation. It uses finder to find token with given code and if it is expired
	 * or does not exist, this method will throw exception.
	 *
	 * If confirmation passes it will return true, otherwise it will return false.
	 *
	 * @param  string $code Confirmation code.
	 *
	 * Brian adds redirects
	 */
	public function attemptConfirmation( $code ) {
		/** @var Token $token */
		$token = $this->finder->findToken( [
			                                   'user_id' => $this->id,
			                                   'code'    => $code,
			                                   'type'    => Token::TYPE_CONFIRMATION,
		                                   ] )->one();

		if ( $token === null || $token->isExpired ) {
			\Yii::$app->session->setFlash( 'danger',\Yii::t( 'user',
			                                                 'The confirmation link is invalid or expired. Please try requesting a new one.' ) );
		} else {
			$token->delete();

			$this->confirmed_at = time();

			\Yii::$app->user->login( $this );

			\Yii::getLogger()->log( 'User has been confirmed',Logger::LEVEL_INFO );

			if ( $this->save( false ) ) {


				\Yii::$app->session->setFlash( 'success',\Yii::t( 'user',
				                                                  'Thank you, registration is now complete.' . 'You will be redirected to the home page in a moment...' ) );
				header( "refresh:5;url=/" );
			} else {
				\Yii::$app->session->setFlash( 'danger',\Yii::t( 'user',
				                                                 'Something went wrong and your account has not been confirmed.' ) );
			}
		}
	}

	public function getProfile() {
		$profile = Profile::find()
		                  ->where( [ 'user_id' => $this->id ] )
		                  ->one();

		return $profile;
	}

	public function getFullName() {
		return trim( $this->getProfile()->name ) == "" ? $this->username : $this->getProfile()->name;
	}

	public function getProfilePhoto() {
		$filePath = "/assets/img/avatar1_small.jpg"; // default avatar
		if ( $this->getProfile()->avatar <> "" ) {
			$aPath = "/uploads/avatar/" . $this->id . "/" . $this->getProfile()->avatar;
			if ( file_exists( \Yii::getAlias( "@appRootFolder" ) . $aPath ) ) {
				$filePath = $aPath;
			}
		}

		return $filePath;
	}

    public function isTemp(){
        return (strpos($this->username, 'guest') !== false );
    }
}