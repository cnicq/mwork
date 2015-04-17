<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" > <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title>{{$PageTitle}}</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->

	<link href="/bootstrap2/media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/style-metro.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/style.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/style-responsive.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

	<link href="/bootstrap2/media/css/uniform.default.css" rel="stylesheet" type="text/css"/>

	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES --> 

	<link href="/bootstrap2/media/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/daterangepicker.css" rel="stylesheet" type="text/css" />

	<link href="/bootstrap2/media/css/fullcalendar.css" rel="stylesheet" type="text/css"/>

	<link href="/bootstrap2/media/css/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>

	<link href="/bootstrap2/media/css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>

	<!-- END PAGE LEVEL STYLES -->
	<link rel="stylesheet" href="/bootstrap2/media/css/DT_bootstrap.css" />

	<link rel="shortcut icon" href="/bootstrap2/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

	<!-- BEGIN HEADER -->

	<div class="header navbar navbar-inverse navbar-fixed-top">

		<!-- BEGIN TOP NAVIGATION BAR -->

		<div class="navbar-inner">

			<div class="container-fluid">

				<!-- BEGIN LOGO -->

				<a class="brand" href="/bootstrap2/index.html">

				<img src="/bootstrap2/media/image/logo.png" alt="logo"/>

				</a>

				<!-- END LOGO -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->

				<a href="/bootstrap2/javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="/bootstrap2/media/image/menu-toggler.png" alt="" />

				</a>          

				<!-- END RESPONSIVE MENU TOGGLER -->            

				<!-- BEGIN TOP NAVIGATION MENU -->              

				<ul class="nav pull-right">

					<!-- BEGIN NOTIFICATION DROPDOWN -->   

					<li class="dropdown" id="header_notification_bar">

						<a href="/bootstrap2/#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-warning-sign"></i>


						</a>

						<ul class="dropdown-menu extended notification">

							

						</ul>

					</li>

					<!-- END NOTIFICATION DROPDOWN -->

					<!-- BEGIN INBOX DROPDOWN -->

					<li class="dropdown" id="header_inbox_bar">

						<a href="/bootstrap2/#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-envelope"></i>


						</a>

						

					</li>

					<!-- END INBOX DROPDOWN -->

					<!-- BEGIN TODO DROPDOWN -->

					<li class="dropdown" id="header_task_bar">

						<a href="/bootstrap2/#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-tasks"></i>

						</a>

						

					</li>

					<!-- END TODO DROPDOWN -->

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown user">

						<a href="/bootstrap2/#" class="dropdown-toggle" data-toggle="dropdown">

						<img alt="" src="/bootstrap2/media/image/avatar1_small.jpg" />

						<span class="username">{{$NickName}}</span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">

							<li><a href="/bootstrap2/extra_profile.html"><i class="icon-user"></i> 档案</a></li>

							<li><a href="/bootstrap2/page_calendar.html"><i class="icon-calendar"></i> 日历</a></li>

							<li><a href="/bootstrap2/inbox.html"><i class="icon-envelope"></i> 我的收件箱</a></li>

							<li><a href="/bootstrap2/#"><i class="icon-tasks"></i> 我的任务</a></li>

							<li class="divider"></li>

							<li><a href="/bootstrap2/extra_lock.html"><i class="icon-lock"></i> 锁定</a></li>

							<li><a href="user/logout"><i class="icon-key"></i> 退出</a></li>

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

				</ul>

				<!-- END TOP NAVIGATION MENU --> 

			</div>

		</div>

		<!-- END TOP NAVIGATION BAR -->

	</div>

	<!-- END HEADER -->
    <div class="copyrights">Collect from <a href="/bootstrap2/http://www.cssmoban.com/" >网页模板</a></div>

	<!-- BEGIN CONTAINER -->

	<div class="page-container">

		@include('mwork.layouts.menu')

		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>Widget Settings</h3>

				</div>

				<div class="modal-body">

					Widget settings form goes here

				</div>

			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN STYLE CUSTOMIZER -->

						<div class="color-panel hidden-phone">

							<div class="color-mode-icons icon-color"></div>

							<div class="color-mode-icons icon-color-close"></div>

							<div class="color-mode">

								<p>THEME COLOR</p>

								<ul class="inline">

									<li class="color-black current color-default" data-style="default"></li>

									<li class="color-blue" data-style="blue"></li>

									<li class="color-brown" data-style="brown"></li>

									<li class="color-purple" data-style="purple"></li>

									<li class="color-grey" data-style="grey"></li>

									<li class="color-white color-light" data-style="light"></li>

								</ul>

								<label>

									<span>Layout</span>

									<select class="layout-option m-wrap small">

										<option value="fluid" selected>Fluid</option>

										<option value="boxed">Boxed</option>

									</select>

								</label>

								<label>

									<span>Header</span>

									<select class="header-option m-wrap small">

										<option value="fixed" selected>Fixed</option>

										<option value="default">Default</option>

									</select>

								</label>

								<label>

									<span>Sidebar</span>

									<select class="sidebar-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected>Default</option>

									</select>

								</label>

								<label>

									<span>Footer</span>

									<select class="footer-option m-wrap small">

										<option value="fixed">Fixed</option>

										<option value="default" selected>Default</option>

									</select>

								</label>

							</div>

						</div>

						<!-- END BEGIN STYLE CUSTOMIZER -->    

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							{{$BigTitle}} <small>{{$SmallTitle}}</small>

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="/">桌面</a> 

								<i class="icon-angle-right"></i>

							</li>

							@if ($Menu1 != '')
							<li><a href="/bootstrap2/{{$Menu1}}">{{$Menu1}}</a>
								<i class="icon-angle-right"></i>
							</li>
							@endif
							@if($Menu2 != '')

							<li><a href="/bootstrap2/{{$Menu2}}">{{$Menu2}}</a></li>
							@endif
						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN CONTENT-->
				@yield('content')
				<!-- END CONTENT-->

			</div>

			<!-- END PAGE CONTAINER-->    

		</div>

		<!-- END PAGE -->

	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->

	<div class="footer">

		<div class="footer-inner">

			2014 &copy; MAPPING Inc.

		</div>

		<div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

		</div>

	</div>

	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->

	<script src="/bootstrap2/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

	<script src="/bootstrap2/media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

	<script src="/bootstrap2/media/js/bootstrap.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>

	<script src="/bootstrap2/media/js/excanvas.min.js"></script>

	<script src="/bootstrap2/media/js/respond.min.js"></script>  

	<![endif]-->   

	<script src="/bootstrap2/media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.blockui.min.js" type="text/javascript"></script>  

	<script src="/bootstrap2/media/js/jquery.cookie.min.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.uniform.min.js" type="text/javascript" ></script>

	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script src="/bootstrap2/media/js/jquery.vmap.js" type="text/javascript"></script>   

	<script src="/bootstrap2/media/js/jquery.vmap.russia.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.vmap.world.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.vmap.europe.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.vmap.germany.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.vmap.usa.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.vmap.sampledata.js" type="text/javascript"></script>  

	<script src="/bootstrap2/media/js/jquery.flot.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.flot.resize.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.pulsate.min.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/date.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/daterangepicker.js" type="text/javascript"></script>     

	<script src="/bootstrap2/media/js/jquery.gritter.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/fullcalendar.min.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.easy-pie-chart.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/jquery.sparkline.min.js" type="text/javascript"></script>  

	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script type="text/javascript" src="/bootstrap2/media/js/select2.min.js"></script>

	<script type="text/javascript" src="/bootstrap2/media/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript" src="/bootstrap2/media/js/DT_bootstrap.js"></script>

	<script type="text/javascript" src="/bootstrap2/media/js/table-advanced.js"></script>   

	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	<script src="/bootstrap2/media/js/app.js" type="text/javascript"></script>

	<script src="/bootstrap2/media/js/index.js" type="text/javascript"></script>        

	<!-- END PAGE LEVEL SCRIPTS -->  

	<script>

		jQuery(document).ready(function() {    

		   App.init(); // initlayout and core plugins

		   Index.init();

		   Index.initJQVMAP(); // init index page's custom scripts

		   Index.initCalendar(); // init index page's custom scripts

		   Index.initCharts(); // init index page's custom scripts

		   Index.initChat();

		   Index.initMiniCharts();

		   Index.initDashboardDaterange();

		   Index.initIntro();

		   //TableAdvanced.init();

		});

	</script>

	@yield('scripts')
	
	<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>