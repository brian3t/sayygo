<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BucketList */
/* @var $form yii\widgets\ActiveForm */
/* @var int $page */
/* @var int $id */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END,
        'viewParams' => [
                'class' => 'BucketItem',
                'relID' => 'bucket-item',
                'value' => \yii\helpers\Json::encode($model->bucketItems),
                'isNewRecord' => ($model->isNewRecord) ? 1 : 0,
                'page' => $page,
                'id' => $id,

        ]
]);

?>

<div class="bucket-list-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->hiddenInput(); ?>

    <?= $form->field($model, 'user_id',['options'=> ['class' => 'hidden']])->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => 'Choose User'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'adventure' => 'Adventure', 'destination' => 'Destination', 'interest' => 'Interest', 'travel' => 'Travel', 'relationship' => 'Relationship', 'leisure' => 'Leisure', 'sexual' => 'Sexual', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tbl_lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group" id="add-bucket-item"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Save', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
