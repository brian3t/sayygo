<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Website */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="website-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'READY' => 'READY', 'CRAWL IN PROCESS' => 'CRAWL IN PROCESS', 'CRAWL DONE' => 'CRAWL DONE', 'IMPORT IN PROCESS' => 'IMPORT IN PROCESS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status_updated')->textInput() ?>

    <?= $form->field($model, 'structure_type')->dropDownList([ 'sahibinden' => 'Sahibinden', 'hurriyetemlak' => 'Hurriyetemlak', '' => '', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
