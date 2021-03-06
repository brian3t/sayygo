<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sayygo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'full_text')->textInput(['maxlength' => 10000]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'is_active_mode')->textInput() ?>

    <?= $form->field($model, 'notification_frequency')->dropDownList([ 'Instant Email' => 'Instant Email', 'Instant SMS' => 'Instant SMS', 'Instant Email and SMS' => 'Instant Email and SMS', 'Daily' => 'Daily', 'Weekly' => 'Weekly', 'Never' => 'Never', ], ['prompt' => '']) ?>

	<?= $form->field($model, 'partner_sex')->dropDownList([ 'Male' => 'Male', 'Female' => 'Female', 'TS/TG' => 'TS/TG', 'Doesn\'\'t matter' => 'Doesn\'\'t matter', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'partner_experience')->dropDownList([ 'Been around the world' => 'Been around the world', 'Experienced international' => 'Experienced international', 'Experienced domestic/regional' => 'Experienced domestic/regional', 'Moderate experience' => 'Moderate experience', 'Little experience' => 'Little experience', 'Never traveled' => 'Never traveled', ], ['prompt' => 'Prefer not to say']) ?>

    <?= $form->field($model, 'partner_num_preference')->dropDownList([ 'One' => 'One', '2 to 10' => '2 to 10', 'More than 10' => 'More than 10', '' => '', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'age_range')->dropDownList([ 'All' => 'All', '18-25' => '18-25', '25-35' => '25-35', '36-45' => '36-45', '46-55' => '46-55', '56-65' => '56-65', '66+' => '66+', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'num_of_partner')->textInput() ?>

    <?= $form->field($model, 'special_needs')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
