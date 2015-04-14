@extends('mwork.layouts.default')

@section('content')
  <!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box green">

							<div class="portlet-title">

								<div class="caption"><i class="icon-globe"></i>候选人列表</div>

								<div class="tools">

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">

									<thead>

										<tr>

											<th>中文名</th>

											<th>英文名</th>
											<th>性别</th>
											<th>所在地</th>

											<th class="hidden-480">电话</th>

											<th class="hidden-480">所在公司</th>

											<th class="hidden-480">职位</th>

											<th style="display:none;"></th>
											<th style="display:none;"></th>
											<th style="display:none;"></th>
											<th style="display:none;"></th>
											<th style="display:none;"></th>
											<th style="display:none;"></th>

										</tr>

									</thead>

									<tbody>

										@foreach ($candidates as $candidate)
										<tr>

											<td>{{$candidate['chinesename']}}</td>

											<td>{{$candidate['englishname']}}</td>
											<td>{{$candidate['gender']}}</td>
											<td>{{$candidate['location']}}</td>

											<td class="hidden-480">{{$candidate['mobile']}}</td>

											<td class="hidden-480">{{$candidate['company']}}</td>

											<td class="hidden-480">{{$candidate['title']}}</td>
											
											<td style="display:none;" >{{$candidate['materialstatus']}}</td>
											<td style="display:none;" >{{$candidate['hometown']}}</td>
											<td style="display:none;">{{$candidate['status']}}</td>
											<td style="display:none;">{{$candidate['resumes']}}</td>
											<td style="display:none;">{{$candidate['notes']}}</td>
											<td style="display:none;">{{$candidate['label']}}</td>
											
										</tr>

										@endforeach
										
									</tfoot>

									</tbody>
								</table>
				<ul class="pagination">
				{{$candidates->links()}}
    			</ul>
							</div>
							
	
						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->
				
@stop