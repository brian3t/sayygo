<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CuserProject */

$this->title                   = 'Create Cuser Project';
$this->params['breadcrumbs'][] = [ 'label' => 'Cuser Projects','url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuser-project-create">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form',[
		'model' => $model,
	] ) ?>

</div>
