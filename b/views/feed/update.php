<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Feed */

$this->title = 'Update Feed: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feed-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
