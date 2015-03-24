<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserTeam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuser-team-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model,'team_id' )->textInput() ?>

	<?= $form->field( $model,'cuser_id' )->textInput() ?>

	<?= $form->field( $model,'teamrole' )->dropDownList( [
		'manager' => 'Manager',
		'member'  => 'Member',
	],[ 'prompt' => '' ] ) ?>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
