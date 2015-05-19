@extends('mwork.layouts.modal')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/profile.css" />
@stop
@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width" id="myTab">
	<ul class="nav nav-tabs">

		<li class="active"><a href="#tab_1_1" data-toggle="tab">基本信息</a></li>
		<li><a href="#tab_1_2" data-toggle="tab">参与项目</a></li>
		<li><a href="#tab_1_3" data-toggle="tab">KPI考核</a></li>

	</ul>

	<div class="tab-content">

		<div class="tab-pane row-fluid active" id="tab_1_1">

		</div>
		<div class="tab-pane row-fluid" id="tab_1_2">
			
		
		</div>
		<div class="tab-pane row-fluid" id="tab_1_3">
			<div class="row-fluid">
				<div class="span12">
					<!-- BEGIN SAMPLE TABLE PORTLET-->

					<div class="portlet box purple">

						<div class="portlet-title">

							<div class="caption"><i class="icon-comments"></i>周报(第1周)</div>

							<div class="tools">

								
							</div>

						</div>
						
						<div class="portlet-body">

							<table class="table table-striped table-hover">

								<thead>

									<tr>

										<th></th>
										<th>推荐数量</th>
										<th>面试数量</th>
										<th>跟进数量</th>
										<th>录入简历数量</th>
										<th>Cold Call数量</th>
										<th>完成情况</th>
										<th>评价</th>

									</tr>

								</thead>

								<tbody>
									<tr>
										<td>星期一</td>
										<td>1</td>
										<td>2</td>
										<th>3</th>
										<th>4</th>
										<th>5</th>
										<td><span class="label label-success">Approved</span></td>
										<th><span class="label label-success">Approved</span></th>
									</tr>

								</tbody>

							</table>

						</div>

					</div>

					<!-- END SAMPLE TABLE PORTLET-->

				</div>
			</div>
		</div>
		
	</div>

<!-- END PAGE CONTENT-->
</div>
				
@stop

@section("scripts")

<script>

		jQuery(document).ready(function() {       
			var tabName = "tab_1_1";
			@if (isset($users)) 
			 		tabName = "tab_1_2";
			@endif

		  	$('#myTab a[href="#' + tabName + '"]').tab('show');  

		});

	</script>
@stop