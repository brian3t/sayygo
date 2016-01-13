<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Brian3t */

$this->title = 'Update Brian3t: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brian3t', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brian3t-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
