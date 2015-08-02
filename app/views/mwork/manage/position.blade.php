@extends('mwork.layouts.default')

@section('metas')
<meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')
<div class="tabbable tabbable-custom tabbable-full-width" id="myTab">
				<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1_1" data-toggle="tab">职位管理</a></li>
						<li><a href="#tab_1_2" data-toggle="tab">Title管理</a></li>
				</ul>

					<div class="tab-content">

						<div class="tab-pane row-fluid active" id="tab_1_1">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>职位管理</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="table1_new" class="btn green">

										新增职位 <i class="icon-plus"></i>

										</button>

									</div>

									<div class="btn-group pull-right">
										

									</div>

								</div>

								<div class="btn-group pull-right">

										

									</div>

								<table class="table table-striped table-hover table-bordered" id="table1">

									<thead>

										<tr>
											<th>职位识别号(自动)</th>
											<th>职位名称</th>

											<th>修改</th>
											<th>保存</th>

										</tr>

									</thead>

									<tbody>

										@foreach ($positions as $position)
										<tr>
											<td>{{$position->GUID}}</td>
											<td>{{$position->name}}</td>
											<td>
												<a class="edit" href="">编辑</a>
											</td>
											<td>
												<a class="delete" href="">删除</a>
											</td>
										</tr>

										@endforeach

									</tbody>

								</table>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->
						</div>
		
						<div class="tab-pane row-fluid " id="tab_1_2">
							选择职位
							<select id='sel_position' name='sel_position'>
											@foreach ($positions as $position)
												<option value={{$position['GUID']}} {{{$posGUID == $position['GUID']?'selected':''}}}> {{$position['name']}}</option>
											@endforeach
										</select>
						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>Title管理</div>

								

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="table2_new" class="btn green">

										新增Title <i class="icon-plus"></i>

										</button>
										<button id="table2_new" class="btn green" onclick="window.location.reload()">

										刷新 <i class="icon-refresh"></i>

										</button>

									</div>

									<div class="btn-group pull-right">
										

									</div>

								</div>

								<div class="btn-group pull-right">

										

									</div>

								<table class="table table-striped table-hover table-bordered" id="table2">

									<thead>

										<tr>
											<th>Title识别号(自动)</th>
											<th>Title名称</th>

											<th>修改</th>
											<th>保存</th>

										</tr>

									</thead>

									<tbody>

										@foreach ($titles as $title)
										<tr>
											<td>{{$title->GUID}}</td>
											<td>{{$title->name}}</td>
											<td>
												<a class="edit" href="">编辑</a>
											</td>
											<td>
												<a class="delete" href="">删除</a>
											</td>
										</tr>

										@endforeach
										

									</tbody>

								</table>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>

			</div>
@stop

@section("scripts")
<script src="/bootstrap2/media/js/table-editable-my.js"></script> 
<script>
	jQuery(document).ready(function() {       
		 MyTableEditable.init("table1", 'position', 'sel_position');
		 MyTableEditable.init("table2", 'title', 'sel_position');
	 	
	 	var tabName = "tab_1_1";
		@if (isset($posGUID) && $posGUID != '') 
		 		tabName = "tab_1_2";
		@endif

	  	$('#myTab a[href="#' + tabName + '"]').tab('show');  
	});
		
	$('#sel_position').change(function(){
		var pn = $("#sel_position").val();
		location.href = "/manage/position/"+pn;
	});
</script>
@stop