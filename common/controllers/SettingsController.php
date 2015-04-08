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

				$model->avatarFile->saveAs( '/var/www/sayygo/uploads/avatar/' . \Yii::$app->user->id . '/' . $model->avatarFile->baseName . '.' . $model->avatarFile->extension );
				$model->avatar = $model->avatarFile->baseName . '.' . $model->avatarFile->extension;
			}
			if ( $model->save() ) {
				\Yii::$app->getSession()->setFlash( 'success',\Yii::t( 'user','Your profile has been updated' ) );
			}
			return $this->refresh();
		}

		return $this->render( 'profile',[ 'model' => $model, ] );
	}
}