<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserProject */

$this->title                   = $model->cuser_id;
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Projects','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-project-view">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( 'Update',[
			'update',
			'cuser_id'   => $model->cuser_id,
			'project_id' => $model->project_id
		],[ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::a( 'Delete',[ 'delete','cuser_id' => $model->cuser_id,'project_id' => $model->project_id ],[
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
			'cuser_id',
			'project_id',
			'projectrole',
		],
	] ) ?>

</div>
