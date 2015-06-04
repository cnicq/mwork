@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/profile.css" />
@stop
@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width" id='myTab'>
				<ul class="nav nav-tabs">

								<li class="active" ><a href="#tab_1_1" data-toggle="tab">项目列表</a></li>

								<li><a href="#tab_1_2" data-toggle="tab">项目详细</a></li>

							</ul>

							<div class="tab-content">

								<div class="tab-pane row-fluid active" id="tab_1_1">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

							<div class="portlet box grey">

								<div class="portlet-title">

									<div class="caption"><i class="icon-globe"></i>我的项目</div>

									<div class="actions">

										<a href="/project/manage" class="btn blue"><i class="icon-pencil"></i> 新增项目</a>

										<div class="btn-group">

											<a class="btn green" href="#" data-toggle="dropdown">

											<i class="icon-cogs"></i> 项目状态

											<i class="icon-angle-down"></i>

											</a>

											<ul class="dropdown-menu pull-right">

												<li><a href="#"><i class="icon-pencil"></i> CC</a></li>
												<li><a href="#"><i class="icon-trash"></i> 反馈</a></li>
												<li><a href="#"><i class="icon-ban-circle"></i> 暂停</a></li>
												<li><a href="#"><i class="icon-ban-circle"></i> 完结-完成</a></li>
												<li><a href="#"><i class="icon-ban-circle"></i> 完结-取消</a></li>

											</ul>

										</div>

									</div>

								</div>

								<div class="portlet-body">

									@include('mwork.project.part_list')

								</div>
								
		
							</div>
						</div>
						<div class="tab-pane row-fluid" id="tab_1_2">

							@include('mwork.project.part_detail')
						</div>

							
						</div>
					</div>

							<!-- END EXAMPLE TABLE PORTLET-->

				

				<!-- END PAGE CONTENT-->
			</div>
				
@stop

@section("scripts")

<script type="text/javascript" src="/bootstrap2/media/js/form-components.js"></script>
<script>

		jQuery(document).ready(function() {       
			var tabName = "tab_1_1";
			@if (isset($projId)) 
			 		tabName = "tab_1_2";
			@endif

		  	$('#myTab a[href="#' + tabName + '"]').tab('show');  

		  	TableAdvanced.initDetailTable('project_candidate_list',clickDetailFunc);

		});

	</script>
@stop