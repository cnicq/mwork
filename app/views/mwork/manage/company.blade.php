@extends('mwork.layouts.default')

@section('content')
<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">

						<li class="active"><a href="#tab_1_1" data-toggle="tab">公司列表</a></li>

						<li><a href="#tab_1_2" data-toggle="tab">新增公司</a></li>

				</ul>

					<div class="tab-content">

						<div class="tab-pane row-fluid active" id="tab_1_1">

							<!-- BEGIN FORM : company list-->

							<div class="portlet-body">

								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
									<thead>
										<tr>
											<th>中文名</th>
											<th>英文名</th>
											<th>城市</th>
											<th>详细地址</th>
											<th></th>
											<th style="display:none">详细</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($companys as $company)
										<tr>
											<td>{{$company['chinesename']}}</td>
											<td>{{$company['englishname']}}</td>
											<td>{{$company['city']}}</td>
											<td>{{$company['location']}}</td>
											<td>修改 | <a href="/manage/company/delete/{{$company['id']}}">删除</a></td>
											<td style="display:none;">@include('mwork.manage.company_detail')</td>
											
										</tr>

										@endforeach
										
									</tfoot>

									</tbody>
								</table>
								<ul class="pagination">
								{{$companys->links()}}
								</ul>
								</div>

							<!-- END FORM : company list-->   
							
						</div>
		
						<div class="tab-pane row-fluid" id="tab_1_2">

							<!-- BEGIN FORM : company manange-->

							<form action="#" method="POST" class="form-horizontal">
								<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
								<h3 class="form-section">公司信息</h3>

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">中文名称</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="" name='chinesename' id='chinesename'>

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">English Name</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="" name='englishname' id='englishname'>

											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">所在城市</label>

											<div class="controls">
											<select class="m-wrap span12" id='city' name='city'>
												@foreach ($citys as $city)
													<option value='{{$city->name}}'> {{$city->text}} </option>
												@endforeach
											</select>

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">详细地址</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="" id='location' name='location'>

											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->        

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">行业</label>

											<div class="controls">

												<select class="m-wrap span12" id='industry' name='industry'>
												@foreach ($industrys as $industry)
													<option value='{{$industry->name}}'> {{$industry->text}} </option>
												@endforeach
											</select>
											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								<h3 class="form-section">联系人信息</h3>

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">中文名称</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder=""  id='linkman_chinesename' name='linkman_chinesename'>

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">English Name</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder=""  id='linkman_englishname' name='linkman_englishname'>

											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">移动电话</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder=""  id='linkman_mobile' name='linkman_mobile'>

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">固定电话</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder=""  id='linkman_tel' name='linkman_tel'>

											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->        

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">Email</label>

											<div class="controls">

												<div class="input-prepend"><span class="add-on">@</span><input class="m-wrap span12" type="text" placeholder=""  id='linkman_email' name='linkman_email'>

												</div>

											</div>
										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">QQ</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder=""  id='linkman_QQ' name='linkman_QQ'>
											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								      

								<div class="form-actions">

									<button type="submit" class="btn blue"><i class="icon-ok"></i> 保存</button>

									<button type="button" class="btn">清除</button>

								</div>

							</form>

							<!-- END FORM : company manage-->   
						</div>
					</div>

			</div>
	</div>
@stop

