<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sayygo-form">

	<?php
	$form = ActiveForm::begin(); ?>
    <?= Html::hiddenInput('bucketitem_id', yii::$app->request->get('bucketitem_id')) ?>
	<?= $form->field( $model,'full_text' )->textarea( [
		                                                  'maxlength' => 10000,
		                                                  'rows'      => 6
	                                                  ] )->label( "Tell us what you want to do and put hashtags (<span class='hashtag'>#</span>) at the beginning and end of key words or phrases. You can have multiple hashtags.<br/>
	                                                  For example, you can type: <br/><i>I want to go to <span class='hashtag'>#</span>Shanghai<span class='hashtag'>#</span> or
	                                                  <span class='hashtag'>#</span>San Francisco<span class='hashtag'>#</span>  in autumn 2016 when there is a <span class='hashtag'>#</span>World Food Convention<span class='hashtag'>#</span>.</i><br/><br/>Begin here:" ) ?>

	<?= BaseHtml::activeHiddenInput( $model,'user_id' ) ?>

	<?php
	$model->populateKeywordIds();
	$initKeywords = [ ];
	//pull keywords' attributes, change description to 'text' for Select2
	foreach ( $model->keywords as $keyword ) {
		$aKeyword         = $keyword->getAttributes();
		$aKeyword['text'] = $aKeyword['description'];
		unset( $aKeyword['description'] );
		$initKeywords[] = $aKeyword;
	}
	$initKeywords = json_encode( $initKeywords );
	// Script to initialize the selection based on the value of the select2 element
	$initScriptKeywords = <<< SCRIPT
function (element, callback) {
	var initKeywords = JSON.parse('{$initKeywords}');
     callback(initKeywords);
    }
SCRIPT;
	echo $form->field( $model,'keywordIds' )->label( 'Keywords in this Sayygo:' )->widget( Select2::classname(),[
		'language'      => 'en',
		'options'       => [
			'disabled' => true
		],
        'data' => [],

        'pluginOptions' => [
			'placeholder'        => '',
			'minimumInputLength' => 0,
			'ajax'               => [
				'url'      => yii\helpers\Url::to( [ 'keyword/get' ] ),
				'dataType' => 'json',
				'data'     => new JsExpression( 'function(term, page) { return {id:term}; }' ),
				'results'  => new JsExpression( 'function(data, page) { return {results: data.results}; }' )
			],
//			'initSelection'      => new JsExpression( $initScriptKeywords ),
			'multiple'           => true,
			'allowClear'         => true,
		],
	] );

	?>
	<?= $form->field( $model,'start_date' )->widget( DatePicker::classname(),[
		'options'       => [
//			'placeholder' => 'yyyy-mm-dd',
                'readonly' => true,
		],
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
			'startDate' => '+0d',
			'todayBtn'  => true
		]
	] )->label( 'When do you prefer to start this Sayygo? (optional)' ); ?>


	<?= $form->field( $model,'end_date' )->widget( DatePicker::classname(),[
		'options'       => [
//			'placeholder' => 'yyyy-mm-dd',

                'readonly' => true,
		],
		'pluginOptions' => [
			'autoclose' => true,
			'format'    => 'yyyy-mm-dd',
			'startDate' => '+0d',
			'todayBtn'  => true,
                'showOn' => 'button',
    'onClose' => 'function(dateText, inst)
    {
        $(this).attr("disabled", false);
    }',
    'beforeShow' => 'function(input, inst)
    {
        $(this).attr("disabled", true);
    }'
		]
	] )->label( 'When do you prefer to end this Sayygo? (optional)' ); ?>

	<?= $form->field( $model,'is_active_mode' )->dropDownList( [
		                                                           '0' => 'No, keep me in listen-only mode',
		                                                           '1' => 'Yes, I want to listen and receive pings from other people'
	                                                           ] )->label( 'Do you want other people to contact you regarding your Sayygo?' ) ?>

	<?= $form->field( $model,'notification_frequency' )->dropDownList([
		                                                                   'Instant Email'         => 'Instant Email',
		                                                                   'Instant SMS'           => 'Instant SMS',
		                                                                   'Instant Email and SMS' => 'Instant Email and SMS',
		                                                                   'Daily'                 => 'Daily',
		                                                                   'Weekly'                => 'Weekly',
		                                                                   'Never'                 => 'Never',
	                                                                   ]) ?>
	<?= $form->field( $model,'partner_sex' )->dropDownList( [
		                                                        'Doesn\'\'t matter' => 'Doesn\'t matter',
		                                                        'Male'              => 'Male',
		                                                        'Female'            => 'Female',
		                                                        'TS/TG'             => 'TS/TG',
	                                                        ] ) ?>

	<?= $form->field( $model,
	                  'partner_experience' )->dropDownList( [ 'Been around the world'         => 'Been around the world',
	                                                            'Experienced international'     => 'Experienced international',
	                                                            'Experienced domestic/regional' => 'Experienced domestic/regional',
	                                                            'Moderate experience'           => 'Moderate experience',
	                                                            'Little experience'             => 'Little experience',
	                                                            'Never traveled'                => 'Never traveled',
	                                                          ],[ 'prompt' => 'Doesn\'t matter' ] ) ?>

    <?= $form->field($model, 'age_range')->dropDownList([ 'All' => 'All', '18-25' => '18-25', '25-35' => '25-35', '36-45' => '36-45', '46-55' => '46-55', '56-65' => '56-65', '66+' => '66+', ], ['prompt' => '']) ?>

    <?= $form->field( $model,'partner_num_preference' )->dropDownList( [
		                                                                   'One'          => 'One',
		                                                                   '2 to 10'      => '2 to 10',
		                                                                   'More than 10' => 'More than 10',
	                                                                   ] ) ?>

	<?= $form->field( $model,'num_of_partner',
	                  [ 'options' => $model->partner_num_preference === '2 to 10' ? [ ] : [ 'class' => 'hidden' ] ] )->textInput()->label( 'Ideal number of travel partners:' ) ?>

    <?= $form->field($model, 'special_needs')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?php
		$request = new \yii\web\Request();
		echo Html::button( '<i class="icon-ban-circle icon-white"></i> Cancel',[
			'class'   => 'btn btn-info',
			'onclick' => 'location.href="' . $request->getReferrer() . '"'
		] ) ?>
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[
			'id'      => 'create_save_btn',
			'class'   => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
			'onClick' => 'submitHandler()'
		] ) ?>
	</div>
	<?php ActiveForm::end();
	$this->registerJsFile( '/assets/js/sayygo_create_form.js',
	                       [ 'depends' => [ \kartik\base\AssetBundle::className() ] ] );
	?>
</div>
