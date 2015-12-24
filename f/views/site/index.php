<style>
	.home-pic{display: none}
</style>
<?php
/* @var $this yii\web\View */
$this->title = 'Sayygo';
?>
<?= \yii\helpers\Html::csrfMetaTags() ?>
<html class="full" lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title?></title>

</head>
<?php
$this->registerJsFile('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
$this->registerJsFile('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js');
?>
<body>

<!-- Navigation -->


<!-- Put your page content here! -->


<form id="browse-input" style="display: none;" action="/b/web/sayygo/browse" method="post"
      data-method="post">
    <label class="control-label">Enter destination</label>
    <input id="keyword" name="keyword">
    <button type="submit" id="create_save_btn" class="btn btn-lg btn-success">Browse</button>
</form>


	<div class="body-content">



	</div>


<?php
$js = <<<JS
	$('.home-pic').hide();
	$('.home-pic').each(function () {
		$(this).fadeIn(_.random(500, 8000))
	});
JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>
</body>
</html>