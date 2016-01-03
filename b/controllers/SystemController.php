<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 1/1/16
 * Time: 7:13 PM
 */
namespace backend\controllers;

use common\models\User;
use dektrium\user\controllers\RegistrationController;
use dektrium\user\controllers\SettingsController;
use dektrium\user\models\Token;
use yii\web\Controller;
use kartik\widgets\Alert;


class SystemController extends Controller
{
	public function actionConfirmEmail($id = null, $code = null)
	{
		if (empty($id) || empty($code)) {
			\Yii::$app->session->addFlash(Alert::TYPE_WARNING, ["title" => "Error",
				"body" => "User Id or Confirmation code is missing."]);
			return $this->goHome();
		}
		$token = Token::findOne(['user_id' => $id, 'code' => $code]);
		/** @var Token $token */
		if (!$token->isExpired && $token->type !== Token::TYPE_CONFIRM_NEW_EMAIL) {
			\Yii::$app->session->addFlash(Alert::TYPE_WARNING, ["title" => "Error",
				"body" => "Wrong confirmation code"]);
			return $this->goHome();
		}
		$user = User::findOne($id);
		/** @var User $user */
		$user->attemptEmailChange($code);

		return $this->redirect(['/user/security/login']);
	}
}