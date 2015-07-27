@extends('mwork.layouts.default')

@section('metas')
<meta name="_token" content="{{ csrf_token() }}"/>
@stop

@section('content')
<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1_2" data-toggle="tab">职位管理</a></li>

						<li><a href="#tab_1_1" data-toggle="tab">抬头管理</a></li>
				</ul>

					<div class="tab-content">

						<div class="tab-pane row-fluid" id="tab_1_1">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>数据管理</div>

								

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="table2_new" class="btn green">

										新增数据 <i class="icon-plus"></i>

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
											<th>数据名-英文</th>

											<th>数据名-中文</th>

											<th>修改</th>
											<th>保存</th>

										</tr>

									</thead>

									<tbody>

										@foreach ($datavalues as $datavalue)
										<tr>
											<td>{{$datavalue->name}}</td>
											<td>{{$datavalue->text}}</td>
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
		
						<div class="tab-pane row-fluid active" id="tab_1_2">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>数据管理</div>

								

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="table2_new" class="btn green">

										新增数据 <i class="icon-plus"></i>

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
											<th>数据名-英文</th>

											<th>数据名-中文</th>

											<th>修改</th>
											<th>保存</th>

										</tr>

									</thead>

									<tbody>

										@foreach ($datavalues as $datavalue)
										<tr>
											<td>{{$datavalue->name}}</td>
											<td>{{$datavalue->text}}</td>
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
		 MyTableEditable.init("table1");
		 MyTableEditable.init("table2");
	 	
	});

	$('#sel_datatype').change(function(){
		var pn = $("#sel_datatype").val();
		location.href = "/manage/datavalue/"+pn;
	});
</script>
@stop