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

									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
										<thead>
											<tr>
												<th>项目ID</th>
												<th>客户</th>
												<th>职位</th>
												<th>所在城市</th>
												<th>起始时间</th>
												<th>结束时间</th>
												<th>负责人</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($projects as $project)
											<tr>
												<td>{{$project['project_id']}}</td>
												<td>{{$project['client_id']}}</td>
												<td>{{$project['position_name']}}</td>
												<td>{{$project['city_name']}}</td>
												<td>{{$project['starttime']}}</td>
												<td>{{$project['endtime']}}</td>
												<td>{{$project['owner_user_id']}}</td>
												<td><a href="/project_{{$project['project_id']}}">详细</a></td>
											</tr>
											@endforeach
										</tfoot>
										</tbody>
									</table>
								<ul class="pagination">
								{{$projects->links()}}
				    			</ul>
								</div>
								
		
							</div>
						</div>
						<div class="tab-pane row-fluid" id="tab_1_2">
							<div class="tabbable tabbable-custom">

								<ul class="nav nav-tabs">

									<li class="active"><a href="#subtab_1_1" data-toggle="tab">项目需求</a></li>

									<li class=""><a href="#subtab_1_2" data-toggle="tab">项目进度</a></li>

									<li class=""><a href="#subtab_1_3" data-toggle="tab">项目后期</a></li>

								</ul>

								<div class="tab-content">

									<div class="tab-pane active" id="subtab_1_1">

									<div class="portlet ">
									<div class="portlet-title">

									<div class="caption"><i class="icon-cogs"></i>项目信息(优先级)</div>

									<div class="tools">

										<a href="javascript:;" class="collapse"></a>

									</div>

									</div>

									<div class="portlet-body">
										
										@include('mwork.manage.company_detail')

										<div class="row-fluid">
										<div class="span6">
											<div class="well">
												<h3>项目内容</h3>
												<div class="row-fluid">

												<div class="span5">
													<address>
													<strong>职位名</strong><br>
													{{$project->position_name}}
												</address>
												</div>
												<div class="span5">

												<address>
													<strong>工作地址</strong><br>
													{{$project->location}}
												</address></div>
												</div>

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>工作描述</strong><br>
														{{$project->desc}}
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>需求人数</strong><br>
														{{$project->head_count}}
													</address>
													</div>
												</div>

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>年收入</strong><br>
														{{$project->income}}万
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>服务费率</strong><br>
														{{$project->fee}}%
													</address></div>
												</div>
										

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>开始时间</strong><br>
														{{$project->starttime}}
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>截止时间</strong><br>
														{{$project->endtime}}
													</address></div>
												</div>
										</div>
									</div>		
									</div>
								</div>
							
												<div class="portlet ">
													<div class="portlet-title">

													<div class="caption"><i class="icon-cogs"></i>项目团队</div>

													<div class="tools">

														<a href="javascript:;" class="collapse"></a>

													</div>

													</div>

													<div class="portlet-body">
														
														<div class="well">

														<h4>项目负责人</h4>

														{{$project->team_id}}

														</div>

														<div class="well">

														<h4>团队贡献</h4>

														</div>
														

													</div>
													</div>
													
											</div>
										</div>

												<div class="tab-pane" id="subtab_1_2">

													<div class="portlet ">

													<div class="portlet-title">

														<div class="caption"><i class="icon-cogs"></i>说明</div>

														<div class="tools">

															<a href="javascript:;" class="collapse"></a>

														</div>

													</div>
													

													<div class="portlet-body">
														
														<address>
														<strong>摘要</strong><br>
														{{$project->desc}}
													</address>
													

													</div>
													</div>

													<div class="portlet ">

													<div class="portlet-title">

														<div class="caption"><i class="icon-cogs"></i>候选人筛选
															<button class="btn purple">候选人搜索 <i class="m-icon-swapright m-icon-white"></i></button>
															<button class="btn purple">候选人添加 <i class="m-icon-swapright m-icon-white"></i></button>

														</div>

														<div class="tools">
															

															<a href="javascript:;" class="collapse"></a>

														</div>

													</div>

													<div class="portlet-body">
														
														<ul class="nav nav-tabs">

															<li class="active"><a href="#ctab_1_1" data-toggle="tab">候选人列表</a></li>

															<li><a href="#ctab_1_2" data-toggle="tab">候选人详细</a></li>

														</ul>

														<div class="tab-content">

															<div class="tab-pane row-fluid active" id="ctab_1_1">
															</div>

															<div class="tab-pane row-fluid active" id="ctab_1_2">
															</div>
														</div>
													</div>

												</div>
												</div>

												<div class="tab-pane" id="subtab_1_3">
													<div class="portlet ">

													<div class="portlet-title">

														<div class="caption"><i class="icon-cogs"></i>项目总结</div>

														<div class="tools">

															<a href="javascript:;" class="collapse"></a>

														</div>

													</div>

													<div class="portlet-body">
														xxx
													</div>

												</div>

												<div class="portlet ">

													<div class="portlet-title">

														<div class="caption"><i class="icon-cogs"></i>项目统计</div>

														<div class="tools">

															<a href="javascript:;" class="collapse"></a>

														</div>

													</div>

													<div class="portlet-body">
														
														
														
														xxx

													</div>

												</div>

												<div class="portlet ">

													<div class="portlet-title">

														<div class="caption"><i class="icon-cogs"></i>项目统计</div>

														<div class="tools">

															<a href="javascript:;" class="collapse"></a>

														</div>

													</div>

													<div class="portlet-body">
														付款信息
														项目统计
														后期跟踪
														

													</div>

												</div>
												</div>

												</div>

												


												</div>

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
			@if (isset($project_id)) 
			 		tabName = "tab_1_2";
			@endif

		  	$('#myTab a[href="#' + tabName + '"]').tab('show');  

		});

	</script>
@stop