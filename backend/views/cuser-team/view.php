<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserTeam */

$this->title                   = $model->team_id;
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Teams','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-team-view">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Update',[
			'update',
			'team_id'  => $model->team_id,
			'cuser_id' => $model->cuser_id
		],[ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::a( 'Delete',[ 'delete','team_id' => $model->team_id,'cuser_id' => $model->cuser_id ],[
			'class' => 'btn btn-danger',
			'data'  => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method'  => 'post',
			],
		] ) ?>
	</p>

	<?= DetailView::widget( [
		'model'      => $model,
		'attributes' => [
			'team_id',
			'cuser_id',
			'teamrole',
		],
	] ) ?>

</div>
