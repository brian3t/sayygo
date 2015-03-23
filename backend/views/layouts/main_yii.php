<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="../../assets/css/twitter-bootstrap/bootstrap.css" rel="stylesheet">
    <link href="../../assets/css/social-jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <link href="../../assets/css/social-coloredicons-buttons.css" rel="stylesheet">
    <link href="../../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../../assets/css/social.plugins.css" rel="stylesheet">
    <link href="../../assets/css/social.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Real Estate Team App',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Real Estate Team App <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    <!-- BEGIN JAVASCRIPT CODES -->
    <!-- BEGIN GENERAL JAVASCRIPT CODE -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js">
    </script>
    <script>window.jQuery || document.write('<script src="../../assets/plugins/jquery/jquery.min.js"><\/script>')</script>
    <script src="../../assets/plugins/jquery.ui/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="../../assets/plugins/jquery.ui.touch-punch/jquery.ui.touch-punch.js"></script>
    <script src="../../assets/plugins/twitter-bootstrap/bootstrap.js"></script>

    <script src="../../assets/plugins/jquery.slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../../assets/plugins/jquery.cookie/jquery.cookie.js"></script>
    <script src="../../assets/plugins/jquery.simplecolorpicker/jquery.simplecolorpicker.js"></script>

    <script src="../../assets/plugins/jquery.uipro/uipro.min.js"></script>

    <script src="../../assets/plugins/jquery.ui.chatbox/jquery.ui.chatbox.js"></script>

    <script src="../../assets/plugins/jquery.livefilter/jquery.liveFilter.js"></script>

    <script src="../../assets/js/chatboxManager.js"></script>

    <script src="../../assets/js/extents.js"></script>
    <script src="../../assets/js/app.js"></script>
    <script src="../../assets/js/demo-settings.js"></script>
    <script src="../../assets/js/sidebar.js"></script>


    <!-- END GENERAL JAVASCRIPT CODE -->

    <!-- BEGIN JAVASCRIPT CODES FOR THE CURRENT PAGE -->
    <script src="../../assets/plugins/jquery.fullcalendar/fullcalendar.min.js"></script>
    <script src="../../assets/plugins/jquery.jqvmap/jquery.vmap.min.js"></script>
    <script src="../../assets/plugins/jquery.jqvmap/maps/jquery.vmap.world.js"></script>
    <script src="../../assets/plugins/jquery.jqvmap/data/jquery.vmap.sampledata.js"></script>
    <script src="../../assets/plugins/jquery.flot/jquery.flot.js"></script>
    <script src="../../assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../../assets/plugins/jquery.flot/jquery.flot.selection.js"></script>
    <script src="../../assets/plugins/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="../../assets/plugins/jquery.justgage/raphael.2.1.0.min.js"></script>
    <script src="../../assets/plugins/jquery.justgage/justgage.1.0.1.min.js"></script>
    <script src="../../assets/plugins/jquery.gritter/jquery.gritter.min.js"></script>
    <script src="../../assets/plugins/bootstrap.daterangepicker/moment.js"></script>
    <script src="../../assets/plugins/bootstrap.daterangepicker/daterangepicker.js"></script>
    <script src="../../assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>


    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/templates/social/assets/plugins/jquery.flot/excanvas.min.js"></script><![endif]-->

    <script src="../../assets/js/dashboard.js"></script>

    <script>
        $(function() {
            var urlAvatar = "../../assets/img/avatar-55.png";
            Dashboard.init({urlAvatar:urlAvatar});
        });
    </script>
    <!-- END JAVASCRIPT CODES FOR THE CURRENT PAGE -->
    <!-- END JAVASCRIPT CODES -->

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-59026211-1', 'auto');
        ga('send', 'pageview');

    </script>

</body>
</html>
<?php $this->endPage() ?>
