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
 * @var \common\models\Profile $model
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

                <div class="form-group">
                    <label class="col-lg-3 control-label">Your languages skill</label>
                    <div class="col-lg-9">
                        <hr class="transparent"/>
                        <?php
                        //init languages
                        $LANGUAGES = \backend\models\Languages::$data;
                        //                echo $form->field($model, 'languages')->label('Languages that you know (optional)')->widget(Select2::classname(), [
                        //                        'language' => 'en',
                        //                        'data' => $LANGUAGES,
                        //                        'showToggleAll' => false,
                        //                        'pluginOptions' => [
                        //                                'placeholder' => '',
                        //                                'minimumInputLength' => 0,
                        //                                'allowClear' => true,
                        //                                'multiple' => true,
                        //                        ],
                        //                ]);
                        //
                        //                $this->registerJs("$('#profile-languages').val(". $model->languages .").change();");

                        $init_lang = json_decode($model->languages);//{"en":{"selected":"en","level":"3"},"el":{"selected":"el","level":"2"}}
                        if (is_null($init_lang)){
                            $init_lang = new stdClass();
                        }
                        foreach ($LANGUAGES as $lang_code => $language):?>

                            <span class="checkbox col-md-3">
                            <label>
                                <input name="lang[<?=$lang_code?>][selected]" type="checkbox" <?= (property_exists($init_lang, $lang_code)?"checked=\"checked\"":"") ?>" value="<?= $lang_code ?>"><?= $language ?>
                            </label>
                            </span>
                            <div class="col-md-3"><select name="lang[<?=$lang_code?>][level]" title="Level" class="form-control form-control-mini col-md-2">
                                    <option value="0" <?= ((property_exists($init_lang, $lang_code) && $init_lang->$lang_code->level == 0)?"selected=\"selected\"":"") ?>>--Level--</option>
                                    <option value="1" <?= ((property_exists($init_lang, $lang_code) && $init_lang->$lang_code->level == 1)?"selected=\"selected\"":"") ?>">Beginner</option>
                                    <option value="2" <?= ((property_exists($init_lang, $lang_code) && $init_lang->$lang_code->level == 2)?"selected=\"selected\"":"") ?>">Intermediate</option>
                                    <option value="3" <?= ((property_exists($init_lang, $lang_code) && $init_lang->$lang_code->level == 3)?"selected=\"selected\"":"") ?>">Fluent</option>
                                </select>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <?=
                $form->field($model, 'special_needs')->textInput(['maxlength'=>800])->label('Your special needs (wheelchair, diet restrictions, etc..)')
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
