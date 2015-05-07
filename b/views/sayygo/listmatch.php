<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\Sayygo;

/* @var $this yii\web\View */
/* @var $kw backend\models\Keyword */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $sourceModel backend\models\Sayygo */
/* @var $kwName string */
/* @var $mtsgs array */

//note that each $model is targetSayygo, and $sourceModel is sourceSayygo, the base sayygo we are comparing against
//

$this->title                   = "Sayygos matching your keyword: #" . ucwords( $kwName ) . "# and sayygo: `" . substr( $sourceModel->full_text,
                                                                                                                       0,
                                                                                                                       40 ) . '...`';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-match">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= GridView::widget( [
		                      'dataProvider' => $dataProvider,
		                      'options'      => [ 'class' => 'table-responsive' ],
		                      'columns'      => [
			                      [ 'class' => 'yii\grid\SerialColumn' ],
//			                      'id',
			                      [
				                      'attribute' => 'user_id',
				                      'label'     => 'Posted by',
				                      'value'     => function ( $model ) {
					                      $creator  = \common\models\User::findOne( $model->user_id );
					                      $identity = $creator->profile;

					                      if ( $identity->getFullName() ) {
						                      return $identity->getFullName();
					                      }

					                      return $creator->username;
				                      }
			                      ],
			                      //todo-b rewrite display match
			                      [
				                      'label'     => 'Compatibility',
				                      'attribute' => 'matchSayygos',
				                      'value'     => function ( $model ) use ( $mtsgs ) {
					                      if ( empty( $mtsgs ) ) {
						                      return "";
					                      }

					                      return $mtsgs[ $model->id ]['compatibility'];
				                      }
			                      ],
			                      [
				                      'label' => 'Exact matching criteria',
				                      'value' => function ( $model ) use ( $sourceModel ) {
					                      return str_replace([",","{","}"],[", ",""],json_encode( Sayygo::getMatch( $sourceModel,$model )['exactMatches'] ));
				                      }
			                      ],
			                      [
				                      'label' => 'Close matching criteria',
				                      'value' => function ( $model ) use ( $sourceModel ) {
					                      return str_replace([",","{","}"],[", ",""],json_encode( Sayygo::getMatch( $sourceModel,$model )['closeMatches'] ));
				                      }
			                      ],
			                      'full_text',
			                      'created_at',
			                      [
				                      'attribute' => 'updated_at',
				                      'label'     => 'Last updated at'
			                      ],
			                      // 'type_id',
			                      // 'status',

//	         'start_date',
//	         'end_date',
			                      // 'is_active_mode',
			                      // 'notification_frequency',
			                      'partner_sex',
			                      'partner_experience',
			                      'partner_num_preference',
			                      [
				                      'attribute' => 'num_of_partner',
				                      'label'     => 'Ideal number of partners',
//				                       'value' => $model->num_of_partner],
				                      'value'     => function ( $model ) { return ( $model->num_of_partner ) ? $model->num_of_partner : "-"; }
			                      ],
			                      [
				                      'class'    => 'yii\grid\ActionColumn',
				                      'template' => '{view}'
			                      ],
		                      ],
	                      ] ); ?>

</div>
