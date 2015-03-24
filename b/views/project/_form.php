<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ready' => 'Ready', 'on hold' => 'On hold', 'on sale' => 'On sale', 'sold' => 'Sold', 'inactive' => 'Inactive', 'completed' => 'Completed', 'request for proposal' => 'Request for proposal', 'cancelled' => 'Cancelled', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => 3]) ?>

	<?= $form->field( $model,'lastupdated' )->textInput( [ 'disabled' => true ] )->label( 'Last updated on' ) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
