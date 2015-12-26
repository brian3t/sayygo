<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register( $this );
\frontend\assets\FrontEndAsset::register($this);
//\backend\assets\AdminAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode( $this->title ) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Sayygo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/b/web/user/login">Log In</a>
                    </li>
                    <li>
                        <a href="user/registration/register"">Sign Up</a>
                    </li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <li>
                        <a href="/b/web/bucket-list/create">Create a Bucket List</a>
                    </li>
                    <li>
                        <a href="/b/web/bucket-list/index">View Bucket Lists</a>
                    </li>
                    <li>
                        <a href="/b/web/sayygo/index">Manage Sayygos</a>
                    </li>
                    <li>
                        <a href="#" onclick="$('#browse-input').toggle();">Browse</a>
                    </li>
                    <li>
                        <a href="/f/web/site/about">About</a>
                    </li>
                    <li>
                        <a href="/f/web/site/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!--        --><?php
	//            NavBar::begin([
	//                'brandLabel' => 'Sayygo',
	//                'brandUrl' => Yii::$app->homeUrl,
	//                'options' => [
	//                    'class' => 'navbar-inverse navbar-fixed-top',
	//                ],
	//            ]);
	//            $menuItems = [
	//                ['label' => 'Home', 'url' => ['/site/index']],
	//                ['label' => 'About', 'url' => ['/site/about']],
	//                ['label' => 'Contact', 'url' => ['/site/contact']],
	//            ];
	//            if (Yii::$app->user->isGuest) {
	//                $menuItems[] = ['label' => 'Signup', 'url' => ['/user/registration/register']];
	//                $menuItems[] = ['label' => 'Login Now', 'url' => '/b/web/user/login'];
	//            } else {
	//                $menuItems[] = [
	//                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
	//                    'url' => ['/user/security/logout'],
	//                    'linkOptions' => ['data-method' => 'post']
	//                ];
	//            }
	//            echo Nav::widget([
	//                'options' => ['class' => 'navbar-nav navbar-right'],
	//                'items' => $menuItems,
	//            ]);
	//            NavBar::end();
	//        ?>

	<div class="container">
		<?= Breadcrumbs::widget( [
			                         'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [ ],
		                         ] ) ?>
		<?php foreach ( Yii::$app->session->getAllFlashes() as $message ):; ?>
			<?php
			echo \kartik\widgets\Growl::widget( [
				                                    'type'          => ( ! empty( $message['type'] ) ) ? $message['type'] : 'danger',
				                                    'title'         => ( ! empty( $message['title'] ) ) ? Html::encode( $message['title'] ) : 'Title Not Set!',
				                                    'icon'          => ( ! empty( $message['icon'] ) ) ? $message['icon'] : 'fa fa-info',
				                                    'body'          => ( ! empty( $message['message'] ) ) ? Html::encode( $message['message'] ) : 'Message Not Set!',
				                                    'showSeparator' => true,
				                                    'delay'         => 0.5,
				                                    //This delay is how long before the message shows
				                                    'pluginOptions' => [
					                                    'delay'     => ( ! empty( $message['duration'] ) ) ? $message['duration'] : 3000,
					                                    //This delay is how long the message shows for
					                                    'placement' => [
						                                    'from'  => ( ! empty( $message['positonY'] ) ) ? $message['positonY'] : 'top',
						                                    'align' => ( ! empty( $message['positonX'] ) ) ? $message['positonX'] : 'right',
					                                    ]
				                                    ]
			                                    ] );
			?>
		<?php endforeach; ?>
<!--		--><?//= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>

<!--<footer class="footer">-->
<!--	<div class="container">-->
<!--		<p class="pull-left">&copy; Sayygo --><?//= date( 'Y' ) ?><!--</p>-->
<!---->
<!--		<p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--	</div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
