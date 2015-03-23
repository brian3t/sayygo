<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model,'address' )->textInput( [ 'maxlength' => 500 ] ) ?>

	<?= $form->field( $model,'region' )->textInput( [ 'maxlength' => 255 ] ) ?>

	<?= $form->field( $model,'description' )->textInput( [ 'maxlength' => 45 ] ) ?>

	<?= $form->field( $model,'status' )->dropDownList( [
		'ready'                => 'Ready',
		'on hold'              => 'On hold',
		'on sale'              => 'On sale',
		'sold'                 => 'Sold',
		'inactive'             => 'Inactive',
		'completed'            => 'Completed',
		'request for proposal' => 'Request for proposal',
		'cancelled'            => 'Cancelled',
	],[ 'prompt' => '' ] ) ?>

	<?= $form->field( $model,'price' )->textInput() ?>

	<?= $form->field( $model,'currency' )->textInput( [ 'maxlength' => 3,'value' => 'USD' ] ) ?>

	<?= $form->field( $model,'lastupdated' )->textInput( [ 'disabled' => true ] )->label( 'Last updated on' ) ?>

	<?= $form->field( $model,'note' )->textarea( [ 'rows' => 6 ] ) ?>

	<?php
	$model->resetCuserIds();
	$initCusers = [ ];
	foreach ( $model->cusers as $cuser ) {
		$aCuser = $cuser->getAttributes();
		if ( array_key_exists( 'name',$aCuser ) ) {
			$aCuser['text'] = $aCuser['name'];
			unset( $aCuser['name'] );
		}
		$initCusers[] = $aCuser;
	}
	$initCusers = json_encode( $initCusers );

	// Script to initialize the selection based on the value of the select2 element
	$initScriptCusers = <<< SCRIPT
	function (element, callback) {
	var initProjects = JSON.parse('{$initCusers}');
	callback(initProjects);
	}
SCRIPT;

	echo $form->field( $model,'cuserIds' )->label( 'Member(s)' )->widget( Select2::classname(),[
		'language'      => 'en',
		'options'       => [
		],
		'pluginOptions' => [
			'placeholder'        => 'Select member(s)..',
			'minimumInputLength' => 0,
			'ajax'               => [
				'url'      => yii\helpers\Url::to( [ 'cuser/get' ] ),
				'dataType' => 'json',
				'data'     => new JsExpression( 'function(term, page) { return {id:term}; }' ),
				'results'  => new JsExpression( 'function(data, page) { return {results: data.results}; }' )
			],
			'initSelection'      => new JsExpression( $initScriptCusers ),
			'multiple'           => true,
			'allowClear'         => true,
		],
	] );

	?>
	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
