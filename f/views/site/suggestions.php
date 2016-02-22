<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Suggestions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <form action= "<?= \yii\helpers\Url::to("@web/site/suggest") ?>" method="post" role="form">
    	<h3>We want your Sayygo experience to be the best it can possibly be, so please, please, please give us your suggestions to improve our free service.</h3>
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
    		<label for="suggestions">Suggestion:</label>
    		<textarea rows="4" cols="80" type="text" class="form-control" name="suggestions" id="suggestions" placeholder=""></textarea>
    	</div>
        <div class="form-group">
            <label for="username">Username (optional):</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="">
        </div>
    
    	<button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
