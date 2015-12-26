<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketList */
/* @var int $page */
/* @var int $id */
$this->title = 'Update Bucket List: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bucket List', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bucket-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
            'model' => $model,
            'page' => $page,
            'id' => $id,

    ]) ?>

</div>
