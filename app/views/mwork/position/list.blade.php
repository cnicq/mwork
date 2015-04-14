@extends('mwork.layouts.default')

@section('content')
  <!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box green">

							<div class="portlet-title">

								<div class="caption"><i class="icon-globe"></i>职位列表</div>

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

										@foreach ($positions as $position)
										<tr>

											<td>{{$position['name']}}</td>
											<td>{{$position['owner_id']}}</td>
											<td>{{$position['created_date']}}</td>
											<td>{{$position['location']}}</td>
											
										</tr>

										@endforeach
										
									</tfoot>

									</tbody>
								</table>
				<ul class="pagination">
				{{$positions->links()}}
    			</ul>
							</div>
							
	
						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->
				
@stop