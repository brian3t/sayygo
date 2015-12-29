<?php
/**
 * Created by PhpStorm.
 * User: tri
 * Date: 4/7/15
 * Time: 4:38 PM
 *
 * Override dektrium setting controller
 *
 */

namespace common\controllers;

use dektrium\user\models\SettingsForm;
use dektrium\user\models\User;
use yii\web\UploadedFile;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use yii\helpers\BaseFileHelper;

class SettingsController extends BaseSettingsController {
	/**
	 *
	 * @var \common\models\Profile $model
	 *
	 * Shows profile settings form.
	 * @return string|\yii\web\Response
	 */
	public function actionProfile() {
		$model = $this->finder->findProfileById( \Yii::$app->user->identity->getId() );

		$this->performAjaxValidation( $model );
		if ( \Yii::$app->request->isPost ) {
			$model->load( \Yii::$app->request->post() );



			$model->avatarFile = UploadedFile::getInstance( $model,'avatarFile' );
			$avatarFolder = dirname(\Yii::$app->getBasePath()) . "/uploads/avatar/" . \Yii::$app->user->id;
			if ( $model->avatarFile) {
				if (is_dir($avatarFolder)){
					BaseFileHelper::removeDirectory( $avatarFolder );
				}
				mkdir( $avatarFolder,0775 );

				$model->avatarFile->saveAs( $avatarFolder . '/' . $model->avatarFile->baseName . '.' . $model->avatarFile->extension );
				$model->avatar = $model->avatarFile->baseName . '.' . $model->avatarFile->extension;
			}
			if ( $model->save() ) {
				\Yii::$app->getSession()->setFlash( 'success',\Yii::t( 'user','Your profile has been updated' ) );
			}
			return $this->refresh();
		}

		return $this->render( 'profile',[ 'model' => $model, ] );
	}

    /**
     * Displays page where user can update account settings (username, email or password).
     * @return string|\yii\web\Response
     */
    public function actionAccount()
    {
        /** @var SettingsForm $model */
        $model = \Yii::createObject(SettingsForm::className());
        if (\Yii::$app->user->identity->isTemp()){
            $model->scenario = $model::SCENARIO_IS_TEMP;
        }

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->user->logout();
            return $this->redirect('/b/web/user/login?pw_updated=1');
        } elseif (\Yii::$app->request->isGet && \Yii::$app->user->identity->isTemp()) {
            $model->username = '';
            $model->email = '';
        }

        return $this->render('account', [
            'model' => $model,
        ]);
    }


}