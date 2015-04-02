<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use kartik\select2\Select2;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model backend\models\Sayygo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sayygo-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model,'full_text' )->textarea( [
		'maxlength' => 10000,
		'rows'      => 6
	] )->label( "Tell us where you want to travel to. Type # to begin hashtag. When you are done hashtagging, type # to finish. You can have multiple hashtags. For example, you can type: <br/><br/> <i>I want to go to #ShangHai# and #San Francisco# around this fall 2015 when there is World Food Convention.</i><br/><br/>Begin here:" ) ?>

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
	echo $form->field( $model,'keywordIds' )->label( 'Keywords in this sayygo:' )->widget( Select2::classname(),[
		'language'      => 'en',
		'options'       => [
			'disabled'           => true
		],
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

	<div class="form-group">
		<?= Html::button( '<i class="icon-ban-circle icon-white"></i> Cancel',[ 'class'   => 'btn btn-info',
		                                                                        'onclick' => 'location.href="/f/web/"'
		] ) ?>
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[
			'id'    => 'create_save_btn',
			'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
			'onClick' => 'submitHandler()'
		] ) ?>
	</div>

	<?php ActiveForm::end();
	$this->registerJsFile( '/assets/js/sayygo_create_form.js',[ 'depends' => [ \kartik\base\AssetBundle::className() ] ] );
	?>
</div>
