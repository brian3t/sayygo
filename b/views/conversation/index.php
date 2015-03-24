<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Conversations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversation-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Create Conversation',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],
//            'id',
			[
				'attribute' => 'message',
				'format'    => 'raw',
				'value'     => function ( $data ) {
					return \yii\helpers\BaseHtml::a( $data->message,$data->id,[ ] );
				}
			],
			[
				'label'  => 'From',
				'format' => 'raw',
				'value'  => function ( $model ) {
					return \yii\helpers\BaseHtml::a( $model->from0->name,\yii\helpers\Url::to( [
						'cuser/view',
						'id' => $model->from0->id
					] ),[ ] );
				},
			],
			[
				'label'  => 'To',
				'format' => 'raw',
				'value'  => function ( $model ) {
					return \yii\helpers\BaseHtml::a( $model->to0->name,\yii\helpers\Url::to( [
						'cuser/view',
						'id' => $model->to0->id
					] ),[ ] );
				},
			],
			'timestamp',
			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>
