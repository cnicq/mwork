<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title>Mapping</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />
	<meta name="csrf-token" content="<?= csrf_token() ?>">

	@yield('metas')

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

	<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/select2_metro.css" />

	<link rel="stylesheet" href="/bootstrap2/media/css/DT_bootstrap.css" />

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="/bootstrap2/media/image/favicon.ico" />

	@yield('csss')

	<!-- BEGIN CORE PLUGINS -->

	<script src="/bootstrap2/media/js/jquery-1.10.1.js" type="text/javascript"></script>

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

	<script type="text/javascript" src="/bootstrap2/media/js/select2.min.js"></script>

	<script type="text/javascript" src="/bootstrap2/media/js/jquery.dataTables.js"></script>

	<script type="text/javascript" src="/bootstrap2/media/js/DT_bootstrap.js"></script>

	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	<script src="/bootstrap2/media/js/app.js" ></script>
	<script src="/bootstrap2/media/js/language.js" charset='gb2312'></script>
	<script src="/assets/js/datatables.fnReloadAjax.js" ></script> 
	<script src="/assets/js/util.js" ></script> 
	<script src="/bootstrap2/media/js/table-advanced.js" ></script>     
	<script src="/bootstrap2/media/js/table-editable.js" ></script> 

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

				<a class="brand" href="index.html">

				MS - Mapping System

				</a>

				<!-- END LOGO -->

				<!-- BEGIN HORIZANTAL MENU -->

				<div class="navbar hor-menu hidden-phone hidden-tablet">


				</div>

				<!-- END HORIZANTAL MENU -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->

				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="/bootstrap2/media/image/menu-toggler.png" alt="" />

				</a>          

				<!-- END RESPONSIVE MENU TOGGLER -->            

				<!-- BEGIN TOP NAVIGATION MENU -->              

				<ul class="nav pull-right">

					<!-- BEGIN NOTIFICATION DROPDOWN -->   

					<li class="dropdown" id="header_notification_bar">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-warning-sign"></i>

						<span class="badge">{{0}}</span>

						</a>

						<ul class="dropdown-menu extended notification">

							<li>

								<p>您收到{{0}}条新的事件</p>

							</li>

							<li>

								<a href="#">

								<span class="label label-success"><i class="icon-plus"></i></span>

								

								<span class="time">2015</span>

								</a>

							</li>

							

							<li class="external">

								<a href="#">查看所提醒 <i class="m-icon-swapright"></i></a>

							</li>

						</ul>

					</li>

					<!-- END NOTIFICATION DROPDOWN -->

					<!-- BEGIN INBOX DROPDOWN -->

					<li class="dropdown" id="header_inbox_bar">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-envelope"></i>

						<span class="badge">{{0}}</span>

						</a>

						<ul class="dropdown-menu extended inbox">

							<li>

								<p>您有{{0}}条新的消息</p>

							</li>

							<li>

								<a href="inbox.html?a=view">

								<span class="photo"><img src="/bootstrap2/media/image/avatar2.jpg" alt="" /></span>

								<span class="subject">

								<span class="from">Jocye</span>

								<span class="time">刚刚</span>

								</span>

								<span class="message">

								该功能开发中

								</span>  

								</a>

							</li>

							

							<li class="external">

								<a href="inbox.html">查看所有消息<i class="m-icon-swapright"></i></a>

							</li>

						</ul>

					</li>

					<!-- END INBOX DROPDOWN -->

					<!-- BEGIN TODO DROPDOWN -->

					<li class="dropdown" id="header_task_bar">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-tasks"></i>

						<span class="badge">{{0}}</span>

						</a>

						<ul class="dropdown-menu extended tasks">

							<li>

								<p>您有{{0}}进行中的任务</p>

							</li>

							<li>

								<a href="#">

								<span class="task">

								<span class="desc">新版本发布</span>

								<span class="percent">30%</span>

								</span>

								<span class="progress progress-success ">

								<span style="width: 30%;" class="bar"></span>

								</span>

								</a>

							</li>

							

							<li class="external">

								<a href="#">查看所有任务 <i class="m-icon-swapright"></i></a>

							</li>

						</ul>

					</li>

					<!-- END TODO DROPDOWN -->

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<img alt="" src="/bootstrap2/media/image/avatar1_small.jpg" />

						<span class="username">{{Auth::user()->username}}</span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">

							<li><a href="/user/profile/{{Auth::user()->id}}"><i class="icon-user"></i> 个人设置</a></li>

							<li><a href="#"><i class="icon-calendar"></i> 日历</a></li>

							<li><a href="#"><i class="icon-envelope"></i> 收件箱(0)</a></li>

							<li><a href="#"><i class="icon-tasks"></i> 任务</a></li>

							<li class="divider"></li>

							<li><a href="/user/logout"><i class="icon-key"></i> 退出系统</a></li>

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

	<!-- BEGIN CONTAINER -->

	<div class="page-container row-fluid">

		@include('mwork.layouts.menu')
		
		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>portlet Settings</h3>

				</div>

				<div class="modal-body">

					<p>Here will be a configuration form</p>

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
		Matching is All - Mapping | 麦聘咨询 &copy; 2015
		</div>

		<div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

		</div>

	</div>

	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	

	<script>

		jQuery(document).ready(function() {       

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			    }
			});
		   App.init();

		   TableAdvanced.init();
		   //TableEditable.init();
		});

	</script>
	@yield('menuScripts')
	@yield('scripts')

</body>

<!-- END BODY -->

</html>