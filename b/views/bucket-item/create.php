<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BucketItem */

$this->title = 'Create Bucket Item';
$this->params['breadcrumbs'][] = ['label' => 'Bucket Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bucket-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
