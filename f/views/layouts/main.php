<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use kartik\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
\frontend\assets\FrontEndAsset::register($this);
//\backend\assets\AdminAsset::register( $this );
$is_admin = (Yii::$app->user->can('admin'));

?>
<?php if (is_object(\Yii::$app->user->identity)) {
    $profilePhoto = \Yii::$app->user->identity->getProfilePhoto();
}
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Core CSS - Include with every page -->
    <link href="/vendor/bower/bootstrap/dist/css/bootstrap.css.map" rel="stylesheet">
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">


</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse-1" aria-expanded="false"><span
                        class="glyphicon glyphicon-menu-hamburger"></span></button>
            <ul class="nav navbar-top-links navbar-left">
                <li class="dropdown">
                    <a class="dropdown-toggle navbar-brand" href="/">
                        Sayygo &nbsp;<i class="fa fa-caret-down dropdown-toggle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="visible-xs"><a href="/">Home</a>
                        </li>
                        <li class="divider"></li>
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li><a href="/b/web/user/login">Log In</a>
                            </li>
                            <li class="divider"></li>

                            <li><a href="/f/web/user/registration/register"">Sign Up</a>
                            </li>
                        <?php else: ?>
                            <li><a class="yii-controls" type="button" data-method="post"
                                   href="/f/web/site/logout"><i
                                            class="fa fa-sign-out fa-fw"></i> Log Out</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="#" id="toggle_browse">Search</a></li>
                </ul>

                <ul class="nav navbar-top-links navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">
                            Manage Sayygos &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/b/web/sayygo/create">Create</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/b/web/sayygo/index">Manage</a></li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>            <!-- Brand and toggle get grouped for better mobile display -->

                <ul class="nav navbar-top-links navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">
                            Bucket List &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/b/web/bucket-list/create">Create</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/b/web/bucket-list/index">Manage</a></li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>

                <ul class="nav navbar-top-links navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">
                            Feedback &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= \yii\helpers\Url::to('@web/site/suggestions') ?>">Suggestions</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= \yii\helpers\Url::to('@web/site/contact') ?>">Contact</a></li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>

                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="/f/web/site/about">
                            About
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-top-links navbar-right">
                    <?php if (! Yii::$app->user->getIsGuest() && ! Yii::$app->user->identity->isTemp()): ?>
                        <style>
                            @media (max-width: 768px) {
                                #navbar-collapse-1 {
                                    min-height: 400px;
                                }
                            }
                        </style>
                        <li class="dropdown">
                            <a class="dropdown-toggle">
                                <?php if (! empty($profilePhoto)) {
                                    echo "<img src= '$profilePhoto' alt='profile' width='29px' height='29px'>";
                                } else {
                                    echo '<i class="fa fa-user fa-fw">';
                                };
                                ?>
                                <span class="username"><?= Yii::$app->user->identity->getFullName() ?>
                                    <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="/b/web/user/settings/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
                                <li class="visible-xs"><a href="/b/web/user/settings/account"><i
                                                class="fa fa-user fa-fw"></i> Account Settings</a>
                                </li>
                                <!--						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                                <!--						</li>-->
                                <li class="divider"></li>

                                <?php if ($is_admin): ?>
                                    <li><a class="yii-controls" type="button" data-method="post"
                                           href="/b/web/admin/del-temp-user"><i
                                                    class="fa fa-sign-out fa-fw"></i> Delete temporary users</a>
                                    </li>
                                <?php endif; ?>
                                <li><a class="yii-controls" type="button" data-method="post" href="/b/web/site/logout"><i
                                                class="fa fa-sign-out fa-fw"></i> Log Out</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    <?php endif; ?>
                    <!-- /.dropdown -->
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <div class="container">
        <form id="browse-input" style="display: none;" action="/b/web/sayygo/browse" method="post"
              data-method="post">
            <label class="control-label">Enter Adventure</label>
            <input id="keyword" name="keyword">
            <button type="submit" id="create_save_btn" class="btn btn-lg btn-success">Browse</button>
        </form>
        <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
        foreach (\Yii::$app->session->getAllFlashes(true) as $key => $message) {
            if (is_array($message) && isset($message[0]) && is_array($message[0])) {
                echo Alert::widget(
                        ['type' => $key,
                                'title' => $message[0]['title'],
                                'body' => $message[0]['body'],
                                'delay' => 10000
                        ]
                );
            } else {
                if (is_array($message) && isset($message['message'])) {
                    echo Alert::widget(
                            ['type' => $message['type'],
                                    'body' => $message['message'],
                                    'delay' => 10000
                            ]
                    );
                } else {
                    echo Alert::widget(
                            ['type' => $key,
                                    'body' => $message,
                                    'delay' => 10000
                            ]
                    );
                }
            }
        }
        ?>
        <?= $content ?>
    </div>
</div>

<!--<footer class="footer">-->
<!--	<div class="container">-->
<!--		<p class="pull-left">&copy; Sayygo --><? //= date( 'Y' )
?><!--</p>-->
<!---->
<!--		<p class="pull-right">--><? //= Yii::powered()
?><!--</p>-->
<!--	</div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
