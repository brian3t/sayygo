<?php

namespace backend\controllers;

use Yii;
use backend\models\CuserProject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CuserProjectController implements the CRUD actions for CuserProject model.
 */
class CuserProjectController extends Controller {
	public function behaviors() {
		return [
			'verbs' => [
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
	/**
	 * Lists all CuserProject models.
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider( [
			'query' => CuserProject::find(),
		] );

		return $this->render( 'index',[
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single CuserProject model.
	 *
	 * @param integer $cuser_id
	 * @param integer $project_id
	 *
	 * @return mixed
	 */
	public function actionView( $cuser_id,$project_id ) {
		return $this->render( 'view',[
			'model' => $this->findModel( $cuser_id,$project_id ),
		] );
	}

	/**
	 * Creates a new CuserProject model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new CuserProject();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view','cuser_id' => $model->cuser_id,'project_id' => $model->project_id ] );
		} else {
			return $this->render( 'create',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Updates an existing CuserProject model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $cuser_id
	 * @param integer $project_id
	 *
	 * @return mixed
	 */
	public function actionUpdate( $cuser_id,$project_id ) {
		$model = $this->findModel( $cuser_id,$project_id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view','cuser_id' => $model->cuser_id,'project_id' => $model->project_id ] );
		} else {
			return $this->render( 'update',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Deletes an existing CuserProject model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $cuser_id
	 * @param integer $project_id
	 *
	 * @return mixed
	 */
	public function actionDelete( $cuser_id,$project_id ) {
		$this->findModel( $cuser_id,$project_id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the CuserProject model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $cuser_id
	 * @param integer $project_id
	 *
	 * @return CuserProject the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $cuser_id,$project_id ) {
		if ( ( $model = CuserProject::findOne( [ 'cuser_id' => $cuser_id,'project_id' => $project_id ] ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
