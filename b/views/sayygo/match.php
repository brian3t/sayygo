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

//$sayygoModel = new Sayygo();

$this->title                   = "Sayygos matching your keyword: $kwName and sayygo: `" . substr( $sourceModel->full_text,
                                                                                                  0,
                                                                                                  40 ) . '...`';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-match">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= GridView::widget( [
		                      'dataProvider' => $dataProvider,
		                      'columns'      => [
			                      [ 'class' => 'yii\grid\SerialColumn' ],
			                      'id',
			                      [
				                      'label' => 'Exact matching criteria',
				                      'value' => function ( $model ) use ( $sourceModel ) {
					                      return json_encode( Sayygo::getMatch( $sourceModel,$model )['exactMatches'] );
				                      }
			                      ],
			                      [
				                      'label' => 'Close matching criteria',
				                      'value' => function ( $model ) use ( $sourceModel ) {
					                      return json_encode( Sayygo::getMatch( $sourceModel,$model )['closeMatches'] );
				                      }
			                      ],
			                      'full_text',
			                      [
				                      'attribute' => 'user_id',
				                      'label'     => 'Posted by',
				                      'value'     => function ( $model ) {
					                      $identity = \common\models\User::findOne( $model->user_id )->profile;

					                      return $identity->name;
				                      }
			                      ],
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
