<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BucketList */

$this->title = 'Create Bucket List';
$this->params['breadcrumbs'][] = ['label' => 'Bucket List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bucket-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
