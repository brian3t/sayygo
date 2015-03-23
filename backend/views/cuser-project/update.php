<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserProject */

$this->title                   = 'Update Cuser Project: ' . ' ' . $model->cuser_id;
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Projects','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->cuser_id,
                                   'url'   => [
	                                   'view',
	                                   'cuser_id'   => $model->cuser_id,
	                                   'project_id' => $model->project_id
                                   ]
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuser-project-update">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form',[
		'model' => $model,
	] ) ?>

</div>
