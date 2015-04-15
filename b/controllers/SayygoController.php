<?php

namespace backend\controllers;

use backend\models\Keyword;
use backend\models\KeywordSayygo;
use backend\models\Languages;
use Yii;
use backend\models\Sayygo;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SayygoController implements the CRUD actions for Sayygo model.
 */
class SayygoController extends Controller {
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
				'rules' => [
					[
						'allow'   => true,
						'actions' => [ '' ],
						'roles'   => [ '?' ],
					],
					[
						'allow'   => true,
						'actions' => [ 'create','index','delete','view','update','match' ],
						'roles'   => [ '@' ],
					],
				],
			],

		];
	}

	/**
	 * Lists all Sayygo models.
	 * @return mixed
	 */
	public function actionIndex() {

		$dataProvider = new ActiveDataProvider( [
			                                        'query' => Sayygo::find()->where( [ 'user_id' => Yii::$app->user->id ] ),
		                                        ] );

		return $this->render( 'index',[
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Lists all Sayygo models matching a specific sayygo, specific keyword.
	 * @return mixed
	 */
	public function actionMatch($id, $kwId) {

		$kwsgTableName = KeywordSayygo::tableName();
		$dataProvider = new ActiveDataProvider( [
			                                        'query' => Sayygo::find()->innerJoin($kwsgTableName,"sayygo.id = $kwsgTableName.sayygo_id")->where(['not', ['sayygo.id' => $id]])->andWhere(["keyword_id"=>$kwId]),
		                                        ] );

		$modelData = $this->findModel( $id );

		return $this->render( 'match',[
			'dataProvider' => $dataProvider,
			'sourceModel' => $modelData,
			'kwName' => Keyword::findOne($kwId)->description
		] );
	}

	/**
	 * Displays a single Sayygo model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView( $id ) {
		$modelData = $this->findModel( $id );

		return $this->render( 'view',[
			'model' => $modelData,
		] );
	}

	/**
	 * Creates a new Sayygo model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model          = new Sayygo();
		$model->user_id = Yii::$app->user->id;

		if ( $model->load( Yii::$app->request->post() ) ) {
			//get plain keywords here
			$keywords   = $_POST['keywords'];
			$keywords   = explode( ',',$keywords );
			$keywordIds = [ ];
			foreach ( $keywords as $kw ) {
				$kwModel = Keyword::findOne( [ 'description' => $kw ] );
				if ( $kwModel == null ) {
					$kwModel              = new Keyword();
					$kwModel->description = $kw;
					$kwModel->save();
				}
				array_push( $keywordIds,$kwModel->id );
			}
			//apply new keywords ID to Sayygo so that they will be linked
			$model->keywordIds = implode( ',',$keywordIds );
			//get plain keywords//
			if ( $model->save() ) {
				return $this->redirect( [ 'view','id' => $model->id ] );
			} else {
				return $this->render( 'create',[
					'model' => $model,
				] );
			}
		} else {
			return $this->render( 'create',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Updates an existing Sayygo model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @var Sayygo $model
	 *
	 * @return mixed
	 */
	public
	function actionUpdate( $id ) {
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) ) {
			//get plain keywords here
			$keywords   = $_POST['keywords'];
			$keywords   = explode( ',',$keywords );
			$keywordIds = [ ];
			foreach ( $keywords as $kw ) {
				$kwModel = Keyword::findOne( [ 'description' => $kw ] );
				if ( $kwModel == null ) {
					$kwModel              = new Keyword();
					$kwModel->description = $kw;
					$kwModel->save();
				}
				array_push( $keywordIds,$kwModel->id );
			}
			//apply new keywords ID to Sayygo so that they will be linked
			$model->keywordIds = implode( ',',$keywordIds );
			//get plain keywords//

			if ( $model->save() ) {
				return $this->redirect( [ 'view','id' => $model->id ] );
			}
		} else {
			return $this->render( 'update',[
				'model' => $model,
			] );
		}
	}

	/**
	 * Deletes an existing Sayygo model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public
	function actionDelete( $id ) {
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the Sayygo model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Sayygo the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected
	function findModel( $id ) {
		if ( ( $model = Sayygo::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
