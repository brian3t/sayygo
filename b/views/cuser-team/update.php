<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserTeam */

$this->title = 'Update Cuser Team: ' . ' ' . $model->team_id;
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Teams','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [
	'label' => $model->team_id,
	'url'   => [ 'view','team_id' => $model->team_id,'cuser_id' => $model->cuser_id ]
];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuser-team-update">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form',[
		'model' => $model,
	] ) ?>

</div>
