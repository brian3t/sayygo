<?php
/* @var $this yii\web\View */
/* @var int $fromuserid
 * @var int $touserid
 * @var int $sayygoid
 * @var string $body
 * @var \common\models\User $toUser
 * @var \backend\models\Sayygo $sayygo
 *
 */

echo \yii\helpers\Html::csrfMetaTags();
$this->registerCssFile( '//cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/css/bootstrapvalidator.min.css' );
?>
	<h1> Compose a message to: <?= $toUser->getFullName() ?></h1>

	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<form id="message" data-toggle="validator" role="form" action="<?= Yii::$app->request->url ?>"
						      method="post">
							<?php echo yii\helpers\Html::beginForm(); ?>
							<div class="form-group">
								<input id="subject" type="text" name="subject" class="form-control"
								       placeholder="Subject" required maxlength="255">

								<div class="help-block with-errors"></div>
							</div>
							<div class="form-group">
								<label for="body">Enter your message here:</label>
							<textarea name="body" class="form-control" rows="8">
Hello <?= $toUser->getFullName() ?>,
								<?php if ( ! empty( $sayygo ) ): { ?>
									I found your Sayygo at http://sayygo.com that matches my desired destinations:
									<?= $sayygo->full_text ?>
								<?php } else: {
									echo "_________________________________\r\n\r\n".str_replace("<br />","",$body);
								}endif; ?>
							</textarea>
							</div>
							<div class="form-group">
								<div class="checkbox">
									<label>
										<input name="send-a-copy" type="checkbox" value="">Send a copy to myself
									</label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary">Send</button>
							<button type="reset" class="btn btn-default">Cancel</button>
							<?php echo \yii\helpers\Html::endForm(); ?>
						</form>
					</div>
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
<?php
$js = <<<JS
	$(document).ready(function(){
	});
JS;
$this->registerJsFile( '//s3-us-west-1.amazonaws.com/sayygo/jscss/validator.min.js',
                       [ 'depends' => '\backend\assets\AdminAsset' ] );
$this->registerJs( $js,\yii\web\View::POS_END,'validate' );