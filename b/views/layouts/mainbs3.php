<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head></head>
<body class="fixed-top">beginPage() ?&gt;


<meta charset="<?= Yii::$app->charset ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--?= Html::csrfMetaTags() ?-->
<title>&lt;?= Html::encode($this-&gt;title) ?&gt;</title>
<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet">
<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
<link href="/assets/css/style-responsive.css" rel="stylesheet">
<link href="/assets/css/style-default.css" rel="stylesheet" id="style_color">
<link href="/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet">
<link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen">
<!--?php $this--->head() ?&gt;


<!--?php $this--->beginBody() ?&gt;
<!-- BEGIN HEADER -->
<div id="header" class="navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="container">
		<div class="container-fluid">
			<div class="navbar-header"><a class="navbar-brand" href="/b/web">
					SAYYGO
				</a></div>
			<!--BEGIN SIDEBAR TOGGLE-->
			<div class="sidebar-toggle-box hidden-sm">
				<div class="icon-reorder"></div>
			</div>
			<!--END SIDEBAR TOGGLE-->
			<!-- BEGIN LOGO -->

			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a class="btn btn-navbar collapsed btn-default" id="main_menu_trigger" data-toggle="collapse"
			   data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="arrow"></span>
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<div id="top_menu" class="nav notify-row navbar-nav">
				<!-- BEGIN NOTIFICATION -->
				<ul class="nav top-menu navbar-nav">
					<!-- BEGIN SETTINGS -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-tasks"></i>
							<span class="badge badge-important">6</span>
						</a>
						<ul class="dropdown-menu extended tasks-bar">
							<li>
								<p>You have 6 pending tasks</p>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="desc">Dashboard v1.3</div>
										<div class="percent">44%</div>
									</div>
									<div class="progress progress-striped active no-margin-bot">
										<div class="progress-bar" style="width: 44%;"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="desc">Database Update</div>
										<div class="percent">65%</div>
									</div>
									<div class="progress progress-striped progress-success active no-margin-bot">
										<div class="progress-bar" style="width: 65%;"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="desc">Iphone Development</div>
										<div class="percent">87%</div>
									</div>
									<div class="progress progress-striped progress-info active no-margin-bot">
										<div class="progress-bar" style="width: 87%;"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="desc">Mobile App</div>
										<div class="percent">33%</div>
									</div>
									<div class="progress progress-striped progress-warning active no-margin-bot">
										<div class="progress-bar" style="width: 33%;"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div class="task-info">
										<div class="desc">Dashboard v1.3</div>
										<div class="percent">90%</div>
									</div>
									<div class="progress progress-striped progress-danger active no-margin-bot">
										<div class="progress-bar" style="width: 90%;"></div>
									</div>
								</a>
							</li>
							<li class="external">
								<a href="#">See All Tasks</a>
							</li>
						</ul>
					</li>
					<!-- END SETTINGS -->
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-envelope-alt"></i>
							<span class="badge badge-important">5</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>You have 5 new messages</p>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="/assets/img/avatar-mini.png" alt="avatar"></span>
									<span class="subject">
									<span class="from">Jonathan Smith</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, this is an example msg.
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="/assets/img/avatar-mini.png" alt="avatar"></span>
									<span class="subject">
									<span class="from">Brian</span>
									<span class="time">10 mins</span>
									</span>
									<span class="message">
									 Hi, Jhon Doe Bhai how are you ?
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="/assets/img/avatar-mini.png" alt="avatar"></span>
									<span class="subject">
									<span class="from">Jason Stathum</span>
									<span class="time">3 hrs</span>
									</span>
									<span class="message">
									    This is awesome dashboard.
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="photo"><img src="/assets/img/avatar-mini.png" alt="avatar"></span>
									<span class="subject">
									<span class="from">Jondi Rose</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, this is metrolab
									</span>
								</a>
							</li>
							<li>
								<a href="#">See all messages</a>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

							<i class="icon-bell-alt"></i>
							<span class="badge badge-warning">7</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>You have 7 new notifications</p>
							</li>
							<li>
								<a href="#">
									<span class="label label-important"><i class="icon-bolt"></i></span>
									Server #3 overloaded.
									<span class="small italic">34 mins</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-warning"><i class="icon-bell"></i></span>
									Server #10 not respoding.
									<span class="small italic">1 Hours</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-important"><i class="icon-bolt"></i></span>
									Database overloaded 24%.
									<span class="small italic">4 hrs</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-success"><i class="icon-plus"></i></span>
									New user registered.
									<span class="small italic">Just now</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-info"><i class="icon-bullhorn"></i></span>
									Application error.
									<span class="small italic">10 mins</span>
								</a>
							</li>
							<li>
								<a href="#">See all notifications</a>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->

				</ul>
			</div>
			<!-- END  NOTIFICATION -->
			<div class="top-nav ">
				<ul class="nav pull-right top-menu navbar-nav">
					<!-- BEGIN SUPPORT -->
					<li class="dropdown mtop5">

						<a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#"
						   data-original-title="Chat">
							<i class="icon-comments-alt"></i>
						</a>
					</li>
					<li class="dropdown mtop5">
						<a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#"
						   data-original-title="Help">
							<i class="icon-headphones"></i>
						</a>
					</li>
					<!-- END SUPPORT -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="/assets/img/avatar1_small.jpg" alt="">
							<span class="username">Brian</span>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu extended logout">
							<li><a href="#"><i class="icon-user"></i> My Profile</a></li>
							<li><a href="#"><i class="icon-cog"></i> My Settings</a></li>
							<li><a class="yii-controls" href="/b/web/site/logout"><i class="icon-key"></i> Log Out</a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div id="container" class="row">
	<!-- BEGIN SIDEBAR -->
	<div class="sidebar-scroll">
		<div id="sidebar" class="collapse navbar-collapse">

			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<div class="navbar-inverse">
				<form class="navbar-form visible-sm">
					<input type="text" class="search-query form-control" placeholder="Search">
				</form>
			</div>
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="sidebar-menu">
				<li class="sub-menu active">
					<a class="" href="/b/web/">
						<i class="icon-dashboard"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon-book"></i>
						<span>Members</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li><a class="" href="/b/web/cuser/index">View All</a></li>
						<li><a class="" href="/b/web/cuser/create">Create New</a></li>
					</ul>
				</li>
				<li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon-book"></i>
						<span>Projects</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub">
						<li><a class="" href="/b/web/project/index">View All</a></li>
						<li><a class="" href="/b/web/project/create">Create New</a></li>
					</ul>
				</li>

				<li>
					<a class="" href="login.html">
						<i class="icon-user"></i>
						<span>Login Page</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN PAGE -->
	<div id="main-content">
		<!-- BEGIN PAGE CONTAINER-->
		<div class="container-fluid">
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<!-- BEGIN THEME CUSTOMIZER-->
					<div id="theme-change" class="hidden-sm">
						<i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme Color:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-green" data-style="green"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-red" data-style="red"></span>
                            </span>
                        </span>
					</div>
					<!-- END THEME CUSTOMIZER-->
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->

					<ul class="breadcrumb">
						<li>
							<a href="/b/web">Home</a>

						</li>
						<li>
							<a href="/b/web/&lt;?= \Yii::$app-&gt;controller-&gt;id ?&gt;/index">
								<!--?= \Yii::$app--->controller-&gt;id ?&gt;</a>

						</li>
						<li class="active">
							Action
						</li>
						<li class="pull-right search-wrap">
							<form action="http://thevectorlab.net/metrolab/search_result.html" class="hidden-sm">
								<div class="input-append search-input-area">
									<input class="form-control" id="appendedInputButton" type="text">
									<button class="btn btn-default" type="button"><i class="icon-search"></i></button>
								</div>
							</form>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<!--?= $content ?-->
			<!-- END PAGE CONTENT-->
		</div>
		<!-- END PAGE CONTAINER-->
	</div>
	<!-- END PAGE -->
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div id="footer">
	2015 © Sayygo.
</div>
<!-- END FOOTER -->

<!--?php $this--->endBody() ?&gt;
<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<!--    <script src="/assets/js/jquery-1.8.3.min.js"></script>-->
<script src="/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<!--    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>-->

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="/assets/js/excanvas.js"></script>
<script src="js/respond.js"></script>
<![endif]-->

<script src="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="/assets/js/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/assets/chart-master/Chart.js"></script>

<!--common script for all pages-->
<script src="/assets/js/common-scripts.js"></script>

<!--script for this page only-->

<script src="/assets/js/easy-pie-chart.js"></script>
<script src="/assets/js/sparkline-chart.js"></script>
<script src="/assets/js/home-page-calender.js"></script>
<script src="/assets/js/chartjs.js"></script>

<!-- END JAVASCRIPTS -->
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-59026211-1', 'auto');
	ga('send', 'pageview');

</script>
<script>
	jQuery('.yii-controls').ready(function () {
//            yii.init();
	});
</script>


<!--?php $this--->endPage() ?&gt;</body>
</html>
