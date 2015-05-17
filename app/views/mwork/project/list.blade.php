@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/profile.css" />
@stop
@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">

								<li class="active"><a href="#tab_1_1" data-toggle="tab">项目列表</a></li>

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

									<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

										<thead>
											<tr>
												<th>项目代号</th>
												<th>客户</th>
												<th>职位</th>
												<th>起始时间</th>
												<th>结束时间</th>
												<th>负责人</th>
												<th>状态</th>
												<th>附件</th>

											</tr>

										</thead>

										<tbody>

											@foreach ($projects as $project)
											<tr>
												<td>{{$project['name']}}</td>
												<td>{{$project['owner_id']}}</td>
												<td>{{$project['created_date']}}</td>
												<td>{{$project['location']}}</td>
												
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
													<a href="#">xxx</a>
												</address>
												</div>
												<div class="span5">

												<address>
													<strong>工作地址</strong><br>
													<a href="#">上海麦聘企业管理咨询有限公司</a>
												</address></div>
												</div>

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>工作描述</strong><br>
														<a href="#">xxx</a>
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>需求人数</strong><br>
														<a href="#">1</a>
													</address>
													</div>
												</div>

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>年收入</strong><br>
														<a href="#">10万</a>
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>服务费率</strong><br>
														<a href="#">10%</a>
													</address></div>
												</div>
										

												<div class="row-fluid">

													<div class="span5">
														<address>
														<strong>开始时间</strong><br>
														<a href="#">2015-1-1</a>
													</address>
													</div>
													<div class="span5">

													<address>
														<strong>截止时间</strong><br>
														<a href="#">015-1-2</a>
													</address></div>
												</div>
										</div>
									</div>		
									</div>
								</div>
							
												<div class="portlet ">
													<div class="portlet-title">

													<div class="caption"><i class="icon-cogs"></i>项目人员</div>

													<div class="tools">

														<a href="javascript:;" class="collapse"></a>

													</div>

													</div>

													<div class="portlet-body">
														
														<div class="well">

														<h4>负责人</h4>

														.xxx

														</div>

														<div class="well">

														<h4>团队贡献</h4>

														.xxx

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
														12312312313123123333333
														12312333333333333333333123
														12312333333213123123
														123123123123
													</address>
													<address>
														<strong>搜索策略</strong><br>
														<a href="#">2015-1-1</a>
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