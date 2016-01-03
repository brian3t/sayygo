<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketList */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="bucket-list-form">

    <?php $form = ActiveForm::begin(['id'=>'active_form_as_guest']);
    ?>

    <!--<?= $form->errorSummary($model); ?>-->

    <?= Html::hiddenInput('login_or_new_acnt') ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'user_id', ['options' => ['class' => 'hidden']
    ])->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'name')->label('Name your bucket list (Example: John\'s list)')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id'=>'bucket_list_cr', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you want to log in or do you want to create an account with us?</p>
                    <p class="text-warning"><small>After creating an account or logging in, this bucket list will be linked with your account.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="login_clicked();"  class="btn btn-primary" data-dismiss="modal">Log In</button>
                    <button type="button" onclick="create_acnt_clicked();" class="btn btn-primary" data-dismiss="modal">Create An Account</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
$this->registerJsFile( '/assets/js/bucket_list_create_form.js',
        [ 'depends' => [ \kartik\base\AssetBundle::className() ] ] );
