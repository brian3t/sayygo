<?php
/**
 * tri
 *
 * Overriding dektrium's user view
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var common\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
			</div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin([
					'id'                     => 'registration-form',
					'enableAjaxValidation'   => true,
					'enableClientValidation' => false
				]); ?>

				<?= $form->field($model, 'username') ?>

				<?= $form->field($model, 'email') ?>

				<?php if ($module->enableGeneratingPassword == false): ?>
					<?= $form->field($model, 'password')->passwordInput() ?>
					<?= $form->field($model, 'password_repeat')->passwordInput(['class' => 'form-control'])->label('Repeat password') ?>
				<?php endif ?>
<!--				--><?//= $form->field($model, 'avatar')->fileInput() ?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Notice:</strong> By signing up, you consent that you are over 18 years old.
				</div>
				<div class="alert alert-info">
					Don't worry. You'll have time later to provide your real name and other preferences after you sign up.
				</div>
				<?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

				<?php ActiveForm::end(); ?>
			</div>
		</div>
		<p class="text-center">
			<?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
		</p>
	</div>
</div>
