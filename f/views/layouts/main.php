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
\backend\assets\AdminAsset::register( $this );
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
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- /.navbar-header -->
		<div class="sidebar-collapse">
			<ul class="nav navbar-top-links navbar-right">
				<li>
					<i class="fa fa-envelope fa-fw"></i><a href="/f/web/site/about">About</a>
				</li>
				<li>
					<i class="fa fa-envelope fa-fw"></i><a href="/f/web/site/contact">Contact</a>
				</li>
				<?php if ( ! Yii::$app->user->getIsGuest() ): ?>
					<li>
						<ul>
							<li><a href="/b/web/user/settings/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<!--						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
							<!--						</li>-->
							<li class="divider"></li>
							<li><a class="yii-controls" type="button" data-method="post" href="/f/web/user/logout"><i
										class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
				<?php else: ?>
					<li>
						<ul>
							<li><a href="/b/web/user/login"><i class="fa fa-user fa-fw"></i> Login</a>
							</li>
							<li class="divider"></li>
							<li><a href="user/registration/register"><i
										class="fa fa-sign-out fa-fw"></i> Register</a>
							</li>
						</ul>
						<!-- /.dropdown-user -->
					</li>
				<?php endif; ?>
				<!-- /.dropdown -->
			</ul>
		</div>
		<!-- /.navbar-top-links -->
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
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; Sayygo <?= date( 'Y' ) ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
