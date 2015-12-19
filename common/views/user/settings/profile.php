<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\Profile $profile
 */

$this->title = Yii::t('user', 'Profile settings');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'profile-form',
                        'options' => [
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data'
                        ],
                        'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                                'labelOptions' => ['class' => 'col-lg-3 control-label'],
                        ],
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnBlur' => false,
                ]); ?>

                <?= $form->field($model, 'name')->label('Full Name (will not be displayed to the public unless you want to)') ?>
                <?= $form->field($model, 'is_show_full_name')->dropDownList([0 => 'No',
                        1 => 'Yes'])->label('Show your full name to the public?') ?>

                <?php
                if (! empty($model->avatar)):
                    ?>
                    <div class="form-group ">
                        <label class="col-lg-3 control-label" for="profile-display-avatar">Current profile
                            picture</label>

                        <div class="col-lg-9">
                            <img src="/uploads/avatar/<?= \Yii::$app->user->id . '/' . $model->avatar ?>" class="avatar"
                                 alt="avatar">
                        </div>
                        <div class="col-sm-offset-3 col-lg-9">
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
                <?= $form->field($model, 'avatarFile')->fileInput()->label('Upload new profile picture') ?>

                <!--				--><? //= $form->field( $model,'bio' )->textarea() ?>

                <?= $form->field($model, 'my_experience')->dropDownList(['Been around the world' => 'Been around the world',
                        'Experienced international' => 'Experienced international',
                        'Experienced domestic/regional' => 'Experienced domestic/regional',
                        'Moderate experience' => 'Moderate experience', 'Little experience' => 'Little experience',
                        'Never traveled' => 'Never traveled',], ['prompt' => 'Doesn\'t matter'])->label('Your travel experience (optional)') ?>

                <?= $form->field($model, 'home_location')->textInput(['maxlength' => 800])->label('Your home location (optional)') ?>

                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 20])->label('Your text phone number (optional)') ?>

                <?php
                //init languages
                $LANGUAGES = \backend\models\Languages::$data;
                $initLanguages = [];
                foreach (explode(',', $model->languages) as $langCode) {
                    array_push($initLanguages, ['id' => $langCode,
                            'text' => ArrayHelper::getValue($LANGUAGES, $langCode, '')]);
                }
                $initLanguages = json_encode($initLanguages);
                // Script to initialize the selection based on the value of the select2 element
                $initScriptLanguages = <<< SCRIPT
				function (element, callback) {
					var initLanguages = JSON.parse('{$initLanguages}');
				     callback(initLanguages);
				    }
SCRIPT;
//                echo $form->field($model, 'languages')->label('Languages that you know (optional)')->widget(Select2::classname(), [
//                        'language' => 'en',
//                        'data' => [],
//                        'pluginOptions' => [
//                                'placeholder' => '',
//                                'minimumInputLength' => 0,
//                                'allowClear' => true,
//                                'multiple' => true,
//                                'ajax' => [
//                                        'url' => yii\helpers\Url::to(['/languages/get']),
//                                        'dataType' => 'json',
//                                        'data' => new JsExpression('function(term, page) { return {id:term}; }'),
//                                        'results' => new JsExpression('function(data, page) { return {results: data.results}; }')
//                                ],
////                                'initSelection' => new JsExpression($initScriptLanguages),
//                        ],
//                ]);

                ?>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <?= \yii\helpers\Html::submitButton(Yii::t('user', 'Save'),
                                ['class' => 'btn btn-block btn-success']) ?><br>
                    </div>
                </div>

                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
