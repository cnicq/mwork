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

				<a class="brand" href="/">

				<img src="/bootstrap2/media/image/logo.png" alt="logo" />

				</a>

				<!-- END LOGO -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->

				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="/bootstrap2/media/image/menu-toggler.png" alt="" />

				</a>          

				<!-- END RESPONSIVE MENU TOGGLER -->            

				<!-- BEGIN TOP NAVIGATION MENU -->              

				<ul class="nav pull-right">

					<!-- BEGIN NOTIFICATION DROPDOWN -->   

					<!-- END NOTIFICATION DROPDOWN -->

					<!-- BEGIN INBOX DROPDOWN -->

					

					<!-- END INBOX DROPDOWN -->

					<!-- BEGIN TODO DROPDOWN -->

					

					<!-- END TODO DROPDOWN -->

					<!-- BEGIN USER LOGIN DROPDOWN -->


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