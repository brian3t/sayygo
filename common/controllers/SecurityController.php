<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace common\controllers;

use backend\models\BucketList;
use backend\models\Sayygo;
use common\models\User;
use dektrium\user\Finder;
use dektrium\user\models\LoginForm;
use dektrium\user\Module;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\controllers\SecurityController as BaseSecurityController;

/**
 * Controller that manages user authentication process.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SecurityController extends BaseSecurityController
{

    /**
     * Displays the login page.
     * @return string|Response
     */
    public function actionLogin($pw_updated = 0)
    {
        if (!\Yii::$app->user->isGuest) {
            $this->goHome();
        }

        $model = \Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
	        if (Yii::$app->request->get('is_temp') == 1){
	            $temp_user_id = Yii::$app->request->get('temp_user_id');
		        //copy bucket list and sayygo from temp to current user
		        $temp_user = User::findOne($temp_user_id);
		        if ($temp_user->isTemp()){
			        $curr_user_id = Yii::$app->user->id;

			        $bucket_lists = BucketList::findAll(['user_id' => $temp_user_id]);
			        if (count($bucket_lists) > 0){
				        foreach ($bucket_lists as $bucket_list){
					        $bucket_list->user_id = $curr_user_id;
					        $bucket_list->update();
				        }
				        \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_INFO, "Your bucket list has been saved. ");
			        }

			        $sayygos = Sayygo::findAll(['user_id' => $temp_user_id]);
			        if (count($sayygos) > 0){
				        foreach ($sayygos as $sayygo){
					        $sayygo->user_id = $curr_user_id;
					        $sayygo->update();
				        }
				        \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_INFO, "Your sayygo has been saved. ");
			        }

		        }
	        }
	        return $this->goBack();
        }

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

}
