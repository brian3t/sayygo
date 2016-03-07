<style>
    .home-pic {
        display: none
    }
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
    <title><?= $this->title ?></title>

</head>
<?php
$this->registerJsFile('/f/web/js/html5shiv.min.js');
$this->registerJsFile('/f/web/js/respond.min.js');
?>
<body>

<!-- Navigation -->


<!-- Put your page content here! -->




<div class="body-content">


</div>


<?php
$js = <<<JS
	$('.home-pic').hide();
	$('.home-pic').each(function () {
		$(this).fadeIn(_.random(500, 8000))
	});
    $('#img_wrapper').appendTo('body');

JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>
<div id="img_wrapper">
    <img id="home_page_img" name="home_page_img" src="/f/web/home_page_collage3.png" border="0" usemap="#home_page_map">
    <a href="/b/web/bucket-list/create" id="cr_bucket_list"></a>
    <a href="/b/web/user/login" id="img_login"></a>
    <a href="/b/web/sayygo/create" id="cr_sayygo"></a>
    <a href="/f/web/user/registration/register" id="img_register"></a>
</div>
</body>
<?php
$this->registerJs('jQuery(document).ready(function($) {

});
', yii\web\View::POS_END);
?>
</html>