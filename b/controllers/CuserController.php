<?php

namespace backend\controllers;

use backend\models\CuserTeam;
use backend\models\Team;
use Yii;
use backend\models\Cuser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseHtml;
use yii\filters\AccessControl;

/**
 * CuserController implements the CRUD actions for Cuser model.
 */
class CuserController extends Controller
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
	            'class' => AccessControl::className(),
	            'only'  => [ 'create','update','admin' ],
	            'rules' => [
		            // allow authenticated users
		            [
			            'allow' => true,
			            'roles' => [ '@' ],
		            ],
		            // everything else is denied
	            ],
            ],

        ];
    }

    /**
     * Lists all Cuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cuser::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

	/*
* Return models' data in json format
*/
	public function actionGet() {
		$models         = Cuser::find()->all();
		$data           = array_map( function ( $model ) {
			$attrs         = $model->attributes;
			$attrs['text'] = $attrs['name'];
			unset ( $attrs['name'] );

			return $attrs;
		},$models );
		$response       = Yii::$app->response;
		$response->data = json_encode( [ 'results' => $data ] );
	}


	/**
     * Displays a single Cuser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	    $model        = $this->findModel( $id );
	    $projectsHtml = [ ];
	    foreach ( $model->projects as $project ) {
		    $projectsHtml[] = BaseHtml::a( substr( $project->description,0,20 ) . "...",Yii::$app->urlManager->createUrl( [
			    'project/view',
			    'id' => $project->id
		    ] ),[ 'target' => '_blank' ] );
	    };

	    $projectsHtml = implode( ', ',$projectsHtml );

	    return $this->render( 'view',[
		    'model'        => $model,
		    'projectsHtml' => $projectsHtml
        ]);
    }

    /**
     * Creates a new Cuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cuser();
	    $model->resetTeamIds();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cuser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cuser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
