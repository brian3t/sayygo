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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
            <ul class="nav navbar-top-links navbar-left">
                <li class="dropdown">
                    <a class="dropdown-toggle navbar-brand" data-toggle="dropdown" href="<?= \yii\helpers\Url::to('index')?>">
                        Sayygo &nbsp;<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li><a href="/b/web/user/login">Log In</a>
                            </li>
                            <li class="divider"></li>

                            <li><a href="user/registration/register"">Sign Up</a>
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
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Manage Sayygo &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/b/web/sayygo/create">Create</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="/b/web/sayygo/index">Manage</a></li>
                            <li class="divider"></li>

                            <li><a href="#" onclick="$('#browse-input').toggle();">Browse</a></li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>            <!-- Brand and toggle get grouped for better mobile display -->

                <ul class="nav navbar-top-links navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Feedback &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= \yii\helpers\Url::to('@web/site/suggestions')?>">Suggestions</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?= \yii\helpers\Url::to('@web/site/contact')?>">Contact</a></li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>

                <ul class="nav navbar-top-links navbar-left">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            About &nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= \yii\helpers\Url::to('@web/site/history')?>">History</a>
                            </li>
                        </ul>
                    </li>
                    <!-- /.dropdown -->
                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <div class="container">
        <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
        foreach (\Yii::$app->session->getAllFlashes(true) as $key => $message) {
            if (is_array($message[0])) {
                echo Alert::widget(
                        ['type' => $key,
                                'title' => $message[0]['title'],
                                'body' => $message[0]['body'],
                                'delay' => 10000
                        ]
                );
            } else {
                if (is_array($message)) {
                    echo Alert::widget(
                            ['type' => $key,
                                    'body' => $message[0],
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
