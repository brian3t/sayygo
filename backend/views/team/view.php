<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\BaseHtml;

/* @var $this yii\web\View */
/* @var $model backend\models\Team */

$this->title                   = $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Teams','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-view">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Update',[ 'update','id' => $model->id ],[ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::a( 'Delete',[ 'delete','id' => $model->id ],[
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method'  => 'post',
			],
		] ) ?>
	</p>
	<?php
	$html = [ ];
	foreach ( $model->cusers as $cuser ) {
		$html[] = BaseHtml::a( $cuser->name,Yii::$app->urlManager->createUrl( [
			'cuser/view',
			'id' => $cuser->id
		] ),[ 'target' => '_blank' ] );
	};

	$html = implode( ', ',$html );
	?>
	<?= DetailView::widget( [
		'model'      => $model,
		'attributes' => [
			'id',
			'name',
			[
				'attribute' => 'cusers',
				'format'    => 'raw',
				'value'     => $html
			]
		],
	] ) ?>

</div>
