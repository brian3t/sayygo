<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
\backend\assets\AdminAsset::register($this);
?>
<?php
if (is_object(\Yii::$app->user->identity)) {
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
<body class="fixed-top">
<?php $this->beginBody() ?>
<div id="page-wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/b/web">Sayygo</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <?php if (! Yii::$app->user->getIsGuest()): ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
                        <!--						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                        <!--						</li>-->
                        <li class="divider"></li>

                        <li><a class="yii-controls" type="button" data-method="post"
                               href="/b/web/admin/del-temp-user"><i
                                        class="fa fa-sign-out fa-fw"></i> Delete temporary users</a>
                        </li>
                        <li class="divider"></li>
                        <li><a class="yii-controls" type="button" data-method="post" href="/b/web/site/logout"><i
                                        class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
            <?php endif; ?>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div id="sidebar" class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <!--					<li class="sidebar-search">-->
                    <!--						<div class="input-group custom-search-form">-->
                    <!--							<input type="text" class="form-control" placeholder="Search...">-->
                    <!--                                <span class="input-group-btn">-->
                    <!--                                <button class="btn btn-default" type="button">-->
                    <!--	                                <i class="fa fa-search"></i>-->
                    <!--                                </button>-->
                    <!--                            </span>-->
                    <!--						</div>-->
                    <!--						<!-- /input-group -->
                    <!--					</li>-->
                    <li>
                        <a href="/b/web/sayygo/"><i class="fa fa-plane fa-fw"></i>View My Sayygos</a>
                    </li>
                    <li>
                        <a href="/b/web/bucket-list/"><i class="fa fa-list fa-fw"></i>View My Bucket lists</a>
                    </li>
                    <li>
                        <a href="/f/web"><i class="fa fa-table fa-fw"></i>Go back to Front page</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <?php
    foreach (\Yii::$app->session->getAllFlashes(true) as $key => $message) {
        if (is_array($message[0])){
        echo Alert::widget(
                ['type' => $key,
                        'title' => $message[0]['title'],
                        'body' => $message[0]['body'],
                        'delay' => 10000
                ]
        );}
        else {
            echo Alert::widget(
                    ['type' => $key,
                            'body' => $message[0],
                            'delay' => 10000
                    ]
            );

        }
    }
    ?>
    <!-- BEGIN PAGE CONTENT-->
    <?= $content ?>
    <!-- END PAGE CONTENT-->

    <!-- /.row -->
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php $this->endBody() ?>
<!-- BEGIN JAVASCRIPTS -->

<?php if (Yii::$app->requestedAction->id === "login"): ?>
    <script>$('#sidebar').hide();</script>
<?php endif; ?>
<?php
//$this->registerJsFile( "/vendor/bower/jquery/dist/jquery.min.map" );
//$this->registerJsFile( "/assets/js/underscore-min.map" );
?>
<!--<script src="/vendor/bower/bootstrap/dist/js/bootstrap.min.js"></script>-->

<!-- END JAVASCRIPTS -->
<script>
    //	(function (i, s, o, g, r, a, m) {
    //		i['GoogleAnalyticsObject'] = r;
    //		i[r] = i[r] || function () {
    //			(i[r].q = i[r].q || []).push(arguments)
    //		}, i[r].l = 1 * new Date();
    //		a = s.createElement(o),
    //			m = s.getElementsByTagName(o)[0];
    //		a.async = 1;
    //		a.src = g;
    //		m.parentNode.insertBefore(a, m)
    //	})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    //
    //	ga('create', 'UA-59026211-1', 'auto');
    //	ga('send', 'pageview');

</script>
</body>
</html>
<?php $this->endPage() ?>
<!--TODO: login page; responsize in main page -->