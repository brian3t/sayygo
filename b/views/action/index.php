<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Create Action',[ 'create' ],[ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'columns'      => [
			[ 'class' => 'yii\grid\SerialColumn' ],
//            'id',
			[
				'attribute' => 'detail',
				'format'    => 'raw',
				'value'     => function ( $data ) {
					return \yii\helpers\BaseHtml::a( $data->detail,$data->id,[ ] );
				}
			],
			'type',
			'timestamp',
			[
				'attribute' => 'cuser_id',
				'label'     => 'Member',
				'format'    => 'raw',
				'value'     => function ( $model ) {
					return \yii\helpers\BaseHtml::a( $model->cuser->name,\yii\helpers\Url::to( [
						'cuser/view',
						'id' => $model->cuser->id
					] ),[ ] );
				}
			],
			[
				'attribute' => 'project_id',
				'label'     => 'Project',
				'format'    => 'raw',
				'value'     => function ( $model ) {
					return \yii\helpers\BaseHtml::a( $model->project->address,\yii\helpers\Url::to( [
						'project/view',
						'id' => $model->project->id
					] ) );
				}
			],

			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>
