<?php

namespace backend\controllers;

use Yii;
use backend\models\Project;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseHtml;
use yii\filters\AccessControl;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
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
				'only'  => [ 'create','update' ],
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
	/*
 * Return models' data in json format
 */
	public function actionGet() {
		$models            = Project::find()->all();
		$data              = array_map( function ( $model ) {
			$attrs         = $model->attributes;
			$attrs['text'] = substr( $attrs['description'],0,20 ) . "...";
			unset ( $attrs['description'] );

			return $attrs;
		},$models );
		$response          = Yii::$app->response;
		$return            = [ ];
		$return['results'] = $data;
		$response->data    = json_encode( $return );
	}


	/**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	    $model      = $this->findModel( $id );
	    $cusersHtml = [ ];
	    foreach ( $model->cusers as $cuser ) {
		    $cusersHtml[] = BaseHtml::a( $cuser->name,Yii::$app->urlManager->createUrl( [
			    'cuser/view',
			    'id' => $cuser->id
		    ] ),[ 'target' => '_blank' ] );
	    };
	    $cusersHtml = implode( ', ',$cusersHtml );

	    return $this->render( 'view',[
            'model' => $this->findModel($id),
            'cusersHtml' => $cusersHtml
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
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
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
