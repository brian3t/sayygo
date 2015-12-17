<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketItem */

$this->title = 'Update Bucket Item: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bucket Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bucket-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
