<?php

namespace backend\controllers;

use backend\models\BucketItem;
use backend\models\BucketItemSearch;
use dektrium\user\models\LoginForm;
use dektrium\user\models\User;
use Yii;
use backend\models\BucketList;
use backend\models\BucketListSearch;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BucketListController implements the CRUD actions for BucketList model.
 */
class BucketListController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete', 'add-bucket-item'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all BucketList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BucketListSearch();
        $query_params = Yii::$app->request->queryParams;
        $query_params['BucketListSearch']['user_id'] = \Yii::$app->user->id;

        $dataProvider = $searchModel->search($query_params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BucketList model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $bucketitem_model_search = (new BucketItemSearch())->search(['BucketItemSearch'=> ['bucket_list_id' => $id]]);
//        $bucketitem_model_search->setSort([
//            'defaultOrder' => 'order asc',
//            'attributes' => [
//                'order' => [
//                    'asc' => ['order' => SORT_ASC]
//                ]
//            ]
//        ]);
        $providerBucketItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->bucketItems,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerBucketItem' => $providerBucketItem,
            'bucketitem_model_search' => $bucketitem_model_search
        ]);
    }

    /**
     * Creates a new BucketList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BucketList();
        $create_form = ((Yii::$app->user->isGuest || Yii::$app->user->identity->isTemp()) ? 'create_as_guest' : 'create');

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            if (\Yii::$app->user->identity->isTemp()) {
                $login_or_new_acnt = Yii::$app->request->post('login_or_new_acnt');
                if ($login_or_new_acnt == 1) {
                    //login
                    \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_INFO, "Your bucket list has been saved. Please log in now.");
                    $temp_user_id = Yii::$app->user->id;
                    Yii::$app->user->logout(true);
                    return $this->redirect(['/user/security/login', 'is_temp' => 1, 'temp_user_id' => $temp_user_id]);
                }
                \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_INFO, "Your bucket list has been saved. Please create an account in order to access your bucket list easily.");
                return $this->redirect(['/user/settings/account', 'id' => \Yii::$app->user->id, 'is_temp' => 1]);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            // before create form shown: if user is not logged in, create a temp user without email, logs in, show toast saying that you can creating bucket list as guest
            if (\Yii::$app->user->isGuest) {
                $user = new User();
                $user->init();
                $user->username = 'guest' . strval(rand(100000, 1000000));
                $user->email = $user->username . '@null.null';
                $user->scenario = 'create';
                if (! $user->create()) {
                    \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_WARNING, ['title' => 'Error',
                        'body' => 'Please register first']);
                    return $this->goHome();
                }
                $login_form_model = \Yii::createObject(LoginForm::className());

                if (! ($login_form_model->load(['login-form' => ['login' => $user->email, 'password' => $user->password,
                        'rememberMe' => 0]]) && $login_form_model->login())
                ) {
                    \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_WARNING, ['title' => 'Error',
                        'body' => 'Please register first']);
                    return $this->goBack();
                }
                \Yii::$app->session->addFlash(\kartik\widgets\Alert::TYPE_INFO, ['title' => 'Please note',
                    'body' => 'You are creating bucket list as a guest.<br/> You can sign up later on.<br/> This bucket list will still be saved.']);
                $create_form = 'create_as_guest';
            }
            $model->user_id = Yii::$app->getUser()->id;

            return $this->render($create_form, [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BucketList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $page = 1)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,
                'page' => $page,
                'id' => $id,

            ]);
        }
    }

    /**
     * Deletes an existing BucketList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BucketList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BucketList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BucketList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Action to load a tabular form grid
     * for BucketItem
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionAddBucketItem($page = 1, $id = null)
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('BucketItem');
            if (! empty($row)) {
                uasort($row, function($a, $b){
                   return ($a['order'] > $b['order']);
                });
                $row = array_values($row);
            }
            $extra_message = '';
            if (count($row) >= 50) {
                $extra_message = '<div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    You can only have 50 bucket items in a list!
</div>';
            }
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('action') == 'load' && empty($row)) || Yii::$app->request->post('action') == 'add') {
                if (count($row) < 50) {
                    $row[] = ['order'=>count($row)];
                }
            }
            return $this->renderAjax('_formBucketItem', ['row' => $row, 'page' => $page,
                'id' => $id,
                'extra_message' => $extra_message
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
