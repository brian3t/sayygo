<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */

$this->title = 'Create Sayygo';
$this->params['breadcrumbs'][] = ['label' => 'Sayygos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sayygo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create_form', [
        'model' => $model,
    ]) ?>

</div>
