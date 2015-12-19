<?php

namespace backend\controllers;

use dektrium\user\models\User;
use Yii;
use kartik\widgets\Alert;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\web\Controller;

/**
 *  implements the CRUD actions for  model.
 */
class AdminController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => ['class'=>AccessRule::className()],
                'rules' => [
                    [
                        'actions' => ['del-temp-user'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ]
            ]
        ];
    }


	public function actionDelTempUser( ) {
        $users = User::deleteAll(['like', 'username', 'guest']);

        if ($users>0){
            \Yii::$app->session->addFlash(Alert::TYPE_SUCCESS,["title"=>"Temporary users deleted","body"=>"$users users deleted."]);
        }
        return $this->goBack();
	}

}
