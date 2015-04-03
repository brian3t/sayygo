<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 4/3/15
 * Time: 10:01 AM
 *
 * Extends dektrium/registration form.
 * Load frontend's registration view instead of dektrium
 */

namespace common\controllers;

use dektrium\user\controllers\RegistrationController as BaseController;
use yii\web\NotFoundHttpException;
use common\models\RegistrationForm;//note that this is overridden


class RegistrationController extends BaseController{
	/**
	 * Displays the registration page.
	 * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionRegister()
	{
		if (!$this->module->enableRegistration) {
			throw new NotFoundHttpException;
		}

		$model = \Yii::createObject(RegistrationForm::className());

		$this->performAjaxValidation($model);

		if ($model->load(\Yii::$app->request->post()) && $model->register()) {
			return $this->render('/message', [
				'title'  => \Yii::t('user', 'Your account has been created'),
				'module' => $this->module,
			]);
		}

		return $this->render('@common/views/registration/register', [
			'model'  => $model,
			'module' => $this->module,
		]);
	}

}