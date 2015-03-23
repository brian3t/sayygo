<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CuserProject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuser-project-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model,'cuser_id' )->textInput() ?>

	<?= $form->field( $model,'project_id' )->textInput() ?>

	<?= $form->field( $model,'projectrole' )->dropDownList( [ 'manager'  => 'Manager',
	                                                          'member'   => 'Member',
	                                                          'follower' => 'Follower',
	],[ 'prompt' => '' ] ) ?>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? 'Create' : 'Update',[ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
