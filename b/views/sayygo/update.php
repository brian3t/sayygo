<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */

$this->title = 'Update Sayygo: ' . ' ' . substr($model->full_text,0,40)."...";
$this->params['breadcrumbs'][] = ['label' => 'Sayygos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sayygo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
