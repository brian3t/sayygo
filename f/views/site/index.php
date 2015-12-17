<style>
	.home-pic{display: none}
</style>
<?php
/* @var $this yii\web\View */
$this->title = 'Sayygo';
?>
<?= \yii\helpers\Html::csrfMetaTags() ?>

<div id="home-page" class="site-index">

	<div id="top" class="row"><img src="/assets/img/home/sayygo.jpg"></div>
	<div class="jumbotron">
        <p><a class="btn btn-success" href="/b/web/bucket-list/create">&nbsp;&nbsp;Fill my bucket list&nbsp;&nbsp;</a></p>
        <p><a class="btn btn-success" href="/b/web/bucket-list/index">View my bucket lists</a></p>

        <p><a class="btn btn-success" href="/b/web/sayygo/create">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Post a Sayygo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></p>

		<p><a class="btn btn-success" href="/b/web/sayygo/index">&nbsp;&nbsp;&nbsp;View my Sayygos&nbsp;&nbsp;&nbsp;</a></p>

		<p><a class="btn btn-info btn-sm"
		      onclick="$('#browse-input').toggle();$('.body-content').animate({opacity:0.4}, 1000);$('#downdown').toggle();$('#upup').toggle();">Browse
				Adventures &nbsp;<span id="downdown" class="glyphicon glyphicon-collapse-down"
				                       aria-hidden="true"></span><span id="upup"
				                                                       class="glyphicon glyphicon-collapse-up"
				                                                       style="display: none"
				                                                       aria-hidden="true"></span></a></p>

		<form id="browse-input" style="display: none;" action="/b/web/sayygo/browse" method="post"
		      data-method="post">
			<label class="control-label">Enter destination</label>
			<input id="keyword" name="keyword">
			<button type="submit" id="create_save_btn" class="btn btn-lg btn-success">Browse</button>
		</form>
	</div>

	<div class="body-content">

		<div class="row">
			<div class="home-pic">
				<img src="/assets/img/home/01.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/02.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/03.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/04.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/05.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/06.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/07.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/08.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/09.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/10.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/11.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/12.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/13.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/14.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/15.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/16.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/17.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/18.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/19.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/20.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/21.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/22.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/23.jpg"/>
			</div>
			<div class="home-pic">
				<img src="/assets/img/home/24.jpg"/>
			</div>

			<div class="home-pic">
				<img src="/assets/img/home/25.jpg"/>
			</div>

		</div>

	</div>
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
