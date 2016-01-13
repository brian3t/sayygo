<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Brian3t */

$this->title = 'Create Brian3t';
$this->params['breadcrumbs'][] = ['label' => 'Brian3t', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brian3t-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
