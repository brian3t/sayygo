<?php

namespace backend\controllers;

use Yii;
use backend\models\CuserTeam;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * CuserTeamController implements the CRUD actions for CuserTeam model.
 */
class CuserTeamController extends Controller {
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
	 * Lists all CuserTeam models.
	 * @return mixed
	 */
	public function actionIndex() {
		$dataProvider = new ActiveDataProvider( [
			'query' => CuserTeam::find(),
		] );

		return $this->render( 'index',[
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single CuserTeam model.
	 *
	 * @param integer $team_id
	 * @param integer $cuser_id
	 *
	 * @return mixed
	 */
	public function actionView( $team_id,$cuser_id ) {
		return $this->render( 'view',[
			'model' => $this->findModel( $team_id,$cuser_id ),
		] );
	}

	/**
	 * Creates a new CuserTeam model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new CuserTeam();

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view','team_id' => $model->team_id,'cuser_id' => $model->cuser_id ] );
		} else {
			return $this->render( 'create',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Updates an existing CuserTeam model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $team_id
	 * @param integer $cuser_id
	 *
	 * @return mixed
	 */
	public function actionUpdate( $team_id,$cuser_id ) {
		$model = $this->findModel( $team_id,$cuser_id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
			return $this->redirect( [ 'view','team_id' => $model->team_id,'cuser_id' => $model->cuser_id ] );
		} else {
			return $this->render( 'update',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Deletes an existing CuserTeam model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $team_id
	 * @param integer $cuser_id
	 *
	 * @return mixed
	 */
	public function actionDelete( $team_id,$cuser_id ) {
		$this->findModel( $team_id,$cuser_id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the CuserTeam model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $team_id
	 * @param integer $cuser_id
	 *
	 * @return CuserTeam the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $team_id,$cuser_id ) {
		if ( ( $model = CuserTeam::findOne( [ 'team_id' => $team_id,'cuser_id' => $cuser_id ] ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
