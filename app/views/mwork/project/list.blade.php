@extends('mwork.layouts.default')

@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width">

							<ul class="nav nav-tabs">

								<li class="active"><a href="#tab_1_1" data-toggle="tab">我的项目</a></li>

								<li class=""><a href="#tab_1_2" data-toggle="tab">详细</a></li>

								<li class=""><a href="#tab_1_3" data-toggle="tab">新增</a></li>

							</ul>

							<div class="tab-content">

								<div class="tab-pane row-fluid" id="tab_1_1">

									

									
								</div>	

								<!--end tab-pane-->

								<div class="tab-pane profile-classic row-fluid" id="tab_1_2">

									

								</div>

								<!--tab_1_2-->

								<div class="tab-pane row-fluid profile-account" id="tab_1_3">

									

								</div>

								<!--end tab-pane-->

						</div>
				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box green">

							<div class="portlet-title">

								<div class="caption"><i class="icon-globe"></i>项目列表</div>

								<div class="tools">

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

									<thead>

										<tr>

											<th>项目名</th>
											<th>Owner</th>
											<th>创建时间</th>
											<th>客户</th>

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

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->
				
@stop