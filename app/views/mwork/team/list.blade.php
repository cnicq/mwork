@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/profile.css" />
@stop
@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width" id="myTab">
			<ul class="nav nav-tabs">

			<li class="active"><a href="#tab_1_1" data-toggle="tab">团队列表</a></li>

			@if (isset($users))
			<li><a href="#tab_1_2" data-toggle="tab">团队详细/KPI/考核</a></li>
			@endif

		</ul>

		<div class="tab-content">

		<div class="tab-pane row-fluid active" id="tab_1_1">

		<!-- BEGIN EXAMPLE TABLE PORTLET-->

		<div class="portlet box grey">

			<div class="portlet-title">

				<div class="caption"><i class="icon-globe"></i>我的团队</div>

				<div class="actions">

					<a href="/team/manage" class="btn blue"><i class="icon-pencil"></i> 新增团队</a>

					<div class="btn-group">


					</div>

				</div>

			</div>

			<div class="portlet-body">

				<table class="table table-striped table-bordered table-hover table-full-width" id="team_table">

					<thead>
						<tr>
							<th>团队名称</th>
							<th>Lead</th>
							<th>成员</th>
							<th>项目数</th>
							<th></th>

						</tr>

					</thead>

					<tbody>

						@foreach ($teams as $team)
						<tr>
							<td>{{$team->name}}</td>
							<td>{{$team->lead_name}}</td>
							<td>{{$team->member_names}}</td>
							<td>{{$team->project_count}}</td>
							<td><a href='team_{{$team->id}}'>详细</a></td>
						</tr>

						@endforeach
						
					</tfoot>

					</tbody>
				</table>
			<ul class="pagination">
			
			</ul>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
	@if (isset($users))
	<div class="tab-pane row-fluid" id="tab_1_2">
		
		<!-- BEGIN EXAMPLE TABLE PORTLET-->

		<div class="portlet box grey">

			<div class="portlet-title">

				<div class="caption"><i class="icon-globe"></i>团队KPI</div>

				<div class="actions">

					<a href="/team/manage" class="btn blue"><i class="icon-pencil"></i> 新增团队</a>

					<div class="btn-group">


					</div>

				</div>

			</div>

			<div class="portlet-body">
			
				<table class="table table-striped table-bordered table-hover table-full-width" id="team_table">

					<thead>
						<tr>
							<th>顾问</th>
							<th>推荐数量</th>
							<th>面试数量</th>
							<th>跟进数量</th>
							<th>录入简历数量</th>
							<th>Cold Call数量</th>
						
							<th>详细</th>
						</tr>

					</thead>

					<tbody>

						@foreach ($users as $user)
						<tr>
							<td>{{$user->chinesename}}|{{$user->englishname}}</td>
							<td>{{$user->recommend}}</td>
							<td>{{$user->interview}}</td>
							<td>{{$user->comment}}</td>
							<td>{{$user->resume}}</td>
							<td>{{$user->coldcall}}</td>
							<td><a href='user/{{$user->id}}/kpi/0/0' target="view_window">详细</a></td>
						</tr>

						@endforeach
						
					</tfoot>

					</tbody>
				</table>
			
			<ul class="pagination">
			
			</ul>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
	@endif
			
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