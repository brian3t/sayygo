<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $kw backend\models\Keyword */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \backend\models\sayygo */

$this->title                   = "People who match: " . ucwords($keyword);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= GridView::widget( [
		                      'dataProvider' => $dataProvider,
		                      'options'      => [ 'class' => 'table-responsive' ],
		                      'columns'      => [
//			                      [ 'class' => 'yii\grid\SerialColumn' ],
//            'id',
		                        ['label' => 'Created by',
		                        'value'=> function($model){
				                        return $model->user->getFullName();
		                        }],
			                      'full_text',
//            'user_id',
			                      'CreatedAtFormatted',
//			                      'UpdatedAtFormatted',
			                      // 'type_id',
			                      // 'status',

//	         'start_date',
//	         'end_date',
			                      // 'is_active_mode',
			                      // 'notification_frequency',
			                      // 'partner_sex',
			                      // 'partner_experience',
			                      // 'partner_num_preference',
			                      // 'num_of_partner',

			                      [ 'class' => 'yii\grid\ActionColumn',
			                      'template'=>'{view}'],
		                      ],
	                      ] ); ?>
	<p>
		<?= Html::a( 'Create a Sayygo',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

</div>
