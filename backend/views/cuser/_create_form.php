<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Cuser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuser-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model,'name' )->textInput( [ 'maxlength' => 400 ] ) ?>
	<?= $form->field( $model,'email' )->textInput( [ 'maxlength' => 100 ] ) ?>
	<?= $form->field( $model,'password' )->passwordInput( [ 'maxlength' => 32 ] ) ?>
	<?= $form->field( $model,'avatar' )->textInput( [ 'maxlength' => 255 ] ) ?>
	<?= $form->field( $model,'phone' )->textInput( [ 'maxlength' => 20 ] ) ?>

	<?php

	$model->resetTeamIds();
	$initTeams = [];
	foreach ( $model->teams as $team ) {
		$aTeam = $team->getAttributes();
		if ( array_key_exists( 'name',$aTeam ) ) {
			$aTeam['text'] = $aTeam['name'];
			unset($aTeam['name']);
		}
		$initTeams[] = $aTeam;
	}
	$initTeams = json_encode($initTeams);

	// Script to initialize the selection based on the value of the select2 element
	$initScriptTeams = <<< SCRIPT
function (element, callback) {
	var initTeams = JSON.parse('{$initTeams}');
     callback(initTeams);
    }
SCRIPT;

	echo $form->field( $model,'teamIds' )->label( 'Teams' )->widget( Select2::classname(),[
		'language'      => 'en',
		'options'       => [
		],
		'pluginOptions' => [
			'placeholder'        => 'Select team(s)..',
			'minimumInputLength' => 0,
			'ajax'               => [
				'url' => yii\helpers\Url::to( [ 'team/get' ] ),
				'dataType' => 'json',
				'data'     => new JsExpression( 'function(term, page) { return {id:term}; }' ),
				'results'  => new JsExpression( 'function(data, page) { return {results: data.results}; }' )
			],
			'initSelection'      => new JsExpression( $initScriptTeams ),
			'multiple'           => true,
			'allowClear'         => true,
		],
	] );


	$model->resetProjectIds();
	$initProjects = [ ];
	foreach ( $model->projects as $project ) {
		$aProject = $project->getAttributes();
		if ( array_key_exists( 'description',$aProject ) ) {
			$aProject['text'] = substr( $aProject['description'],0,20 ) . "...";
			unset( $aProject['description'] );
		}
		$initProjects[] = $aProject;
	}
	$initProjects = json_encode( $initProjects );

	// Script to initialize the selection based on the value of the select2 element
	$initScriptProjects = <<< SCRIPT
function (element, callback) {
	var initProjects = JSON.parse('{$initProjects}');
     callback(initProjects);
    }
SCRIPT;

	echo $form->field( $model,'projectIds' )->label( 'Projects' )->widget( Select2::classname(),[
		'language'      => 'en',
		'options'       => [
		],
		'pluginOptions' => [
			'placeholder'        => 'Select project(s)..',
			'minimumInputLength' => 0,
			'ajax'               => [
				'url'      => yii\helpers\Url::to( [ 'project/get' ] ),
				'dataType' => 'json',
				'data'     => new JsExpression( 'function(term, page) { return {id:term}; }' ),
				'results'  => new JsExpression( 'function(data, page) { return {results: data.results}; }' )
			],
			'initSelection'      => new JsExpression( $initScriptProjects ),
			'multiple'           => true,
			'allowClear'         => true,
		],
	] );


	?>
	<div style="display:block; float: left; width: 100%; clear: both; height: 16px"></div>
	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
