<?php

namespace backend\controllers;

use backend\models\Keyword;
use backend\models\KeywordSayygo;
use backend\models\Languages;
use backend\models\MatchSayygo;
use Yii;
use backend\models\Sayygo;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\QueryBuilder;
use yii\web\Request;

/**
 * SayygoController implements the CRUD actions for Sayygo model.
 */
class SayygoController extends Controller {
//	public $enableCsrfValidation = false;
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
						'actions' => [ 'browse','view' ],
						'roles'   => [ '?' ],
					],
					[
						'allow'   => true,
						'actions' => [
							'create',
							'index',
							'delete',
							'update',
							'match',
							'matchall',
							'listmatch','browse','view','testing'
						],
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

	/*
	 * Perform match on a specific sayygo, specific keyword
	 * Save result to match_sayygo table
	 * Similar to actionMatchall, but this is only for a specific sayygo, specific kw
	 * TODO-B: Sayygo OnSave() and onUpdate() and onCreate() will fire this automatically
	 */
	public function actionMatch( $id,$kwId ) {
		$sourceSayygo = Sayygo::findOne( $id );
		$sayygos      = Keyword::findOne( $kwId )->sayygos;
		foreach ( $sayygos as $targetSayygo ) {
			if ( $targetSayygo->id == $id ) {
				continue;
			}
			$matchingResult = Sayygo::getMatch( $sourceSayygo,$targetSayygo );
			//store keyword, sayygo first , sayygo second
			$sayygo_first_id  = min( $sourceSayygo->id,$targetSayygo->id );
			$sayygo_second_id = max( $sourceSayygo->id,$targetSayygo->id );
			$aMatch           = MatchSayygo::findOne( [
				                                          'keyword_id'       => $kwId,
				                                          'sayygo_first_id'  => $sayygo_first_id,
				                                          'sayygo_second_id' => $sayygo_second_id
			                                          ] );
			if ( $aMatch === null ) {
				$newMatch = new MatchSayygo();
			} else {
				$newMatch = $aMatch;
			}

			//store matching array as json array with column name only
			$newMatch->keyword_id       = $kwId;
			$newMatch->sayygo_first_id  = $sayygo_first_id;
			$newMatch->sayygo_second_id = $sayygo_second_id;
			$newMatch->exact_matches    = json_encode( $matchingResult['exactMatches'] );
			$newMatch->close_matches    = json_encode( $matchingResult['closeMatches'] );
			$newMatch->compatibility    = $matchingResult['compatibility'];
			$newMatch->save();
		}
	}


	/**
	 * Lists all Sayygo models matching a specific sayygo, specific keyword.
	 * In table format
	 * @return mixed
	 */
	public function actionListmatch( $id,$kwId ) {
		$mtsgTableName = MatchSayygo::tableName();
		$this->actionMatch( $id,$kwId );
		$modelData = $this->findModel( $id );
		$mtsgs     = $modelData->getMatchSayygos();
		$mtsgs     = ArrayHelper::index( $mtsgs->all(),
		                                 'sayygo_id' );//get all attributes, index by target sayygo's id
		$query     = new Query();
		$query->select( 'sayygo.*' )->from( 'sayygo' )->innerJoin( "(select * from $mtsgTableName mtsg where mtsg.sayygo_second_id = $id) as mtsg2",
		                                                           "mtsg2.sayygo_first_id = sayygo.id" )->where( [
			                                                                                                         'not',
			                                                                                                         [ 'sayygo.id' => $id ]
		                                                                                                         ] );
		$dataProvider = new ActiveDataProvider( [
			                                        'query' => Sayygo::find()->innerJoin( "(select * from $mtsgTableName mtsg where mtsg.sayygo_first_id = $id) as mtsg1",
			                                                                              "mtsg1.sayygo_second_id = sayygo.id" )->where( [
				                                                                                                                             'not',
				                                                                                                                             [ 'sayygo.id' => $id ]
			                                                                                                                             ] )
			                                                         ->union( $query )
			                                                         ->where( [ 'keyword_id' => $kwId ] )
			                                                         ->orderBy( 'compatibility desc' )
			                                                         ->limit( 1000 ),
		                                        ] );

		return $this->render( 'listmatch',[
			'dataProvider' => $dataProvider,
			'sourceModel'  => $modelData,
			'kwName'       => Keyword::findOne( $kwId )->description,
			'mtsgs'        => $mtsgs
		] );
	}

	public function beforeAction($action){
		if ($action->id == "browse"){
			$this->enableCsrfValidation = false;
		}
		return parent::beforeAction($action);
	}

	/**
	 * Lists all Sayygo models matching a specific sayygo, specific keyword.
	 * In table format
	 * @return mixed
	 */
	public function actionBrowse() {

		$keyword = \yii::$app->request->post('keyword');
		$keyword = filter_input(INPUT_POST,'keyword');
		$keyword = str_replace("  "," ", strtolower($keyword));

		$kwId = Keyword::findOne(['description'=>$keyword]);
		if (empty($kwId)){
			$kwId = "null";
		}
		else {
			$kwId = $kwId->id;
		}

		$dataProvider = new ActiveDataProvider( [
			                                        'query' => Sayygo::find()->innerJoin("(SELECT * FROM " . KeywordSayygo::tableName() ." WHERE keyword_id = $kwId) as kwsg",'sayygo.id = kwsg.sayygo_id')->limit(1000),
		                                        ] );

		return $this->render( 'browse',[
			'dataProvider' => $dataProvider,
			'keyword' => $keyword
		] );
	}

	/*
	 * testing
	 */
	public function actionTesting($id){
		$sg = Sayygo::findOne($id);
		$sgs = $sg->getSayygosShareKeyword();
	}


	/**
	 * Match all Sayygo models
	 * @return mixed
	 * @var \backend\models\Keyword $kw
	 */
	public static function actionMatchall() {
		$kws           = Keyword::find()->all();
		$numOfKeyword  = count( $kws );
		$kwsgTableName = KeywordSayygo::tableName();
		$sayygoModel   = new Sayygo();

		//for each keyword
		$numOfSayygo = $new = $existing = 0;
		foreach ( $kws as $kw ) {
			//find group of sayygo having that keyword
			$sayygos = $kw->sayygos;
			$numOfSayygo += count( $sayygos );
			//foreach i
			for ( $i = 0;$i < ( count( $sayygos ) - 1 );$i ++ ) {
				//foreach j
				for ( $j = $i + 1;$j < count( $sayygos );$j ++ ) {
					//match sayygo i and sayygo j
					//store matching info in table match_sayygo
					$matchingResult = Sayygo::getMatch( $sayygos[ $i ],$sayygos[ $j ] );
					//store keyword, sayygo first , sayygo second
					$sayygo_first_id  = min( $sayygos[ $i ]->id,$sayygos[ $j ]->id );
					$sayygo_second_id = max( $sayygos[ $i ]->id,$sayygos[ $j ]->id );
					$aMatch           = MatchSayygo::findOne( [
						                                          'keyword_id'       => $kw->id,
						                                          'sayygo_first_id'  => $sayygo_first_id,
						                                          'sayygo_second_id' => $sayygo_second_id
					                                          ] );
					if ( $aMatch === null ) {
						$newMatch = new MatchSayygo();
						$new ++;
					} else {
						$newMatch = $aMatch;
						$existing ++;
					}

					//store matching array as json array with column name only
					$newMatch->keyword_id       = $kw->id;
					$newMatch->sayygo_first_id  = $sayygo_first_id;
					$newMatch->sayygo_second_id = $sayygo_second_id;
					$newMatch->exact_matches    = json_encode( $matchingResult['exactMatches'] );
					$newMatch->close_matches    = json_encode( $matchingResult['closeMatches'] );
					$newMatch->compatibility    = $matchingResult['compatibility'];
					$newMatch->save();
				}
			}
		}

		return compact( 'numOfKeyword','numOfSayygo','new','existing' );
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
		$isOwner = (Yii::$app->user->id === $modelData->user_id);

		return $this->render( 'view',[
			'model' => $modelData,
			'isOwner' => $isOwner
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
				$kw      = preg_replace( '/(\s)+/',"",strtolower( $kw ) );
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
	public function actionUpdate( $id ) {
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) ) {
			//get plain keywords here
			$keywords   = $_POST['keywords'];
			$keywords   = explode( ',',$keywords );
			$keywordIds = [ ];
			foreach ( $keywords as $kw ) {
				$kw      = preg_replace( '/(\s)+/',"",strtolower( $kw ) );
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
