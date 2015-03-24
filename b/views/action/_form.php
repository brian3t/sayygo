<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Action */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList([ 'create' => 'Create', 'like' => 'Like', 'comment' => 'Comment', 'share' => 'Share', 'update' => 'Update', 'delete' => 'Delete', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'detail')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <?= $form->field( $model,'cuser_id' )->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
