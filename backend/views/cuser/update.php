<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cuser */

$this->title = 'Update Cuser: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render( '_create_form',[
        'model' => $model,
    ]) ?>

</div>
