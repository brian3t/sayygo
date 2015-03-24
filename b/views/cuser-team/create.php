<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CuserTeam */

$this->title                   = 'Create Cuser Team';
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Teams','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-team-create">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form',[
		'model' => $model,
	] ) ?>

</div>
