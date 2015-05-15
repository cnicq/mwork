@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/datepicker.css" />
@stop
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

								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
									<thead>
										<tr>
											<th>中文名</th>
											<th>英文名</th>
											<th>城市</th>
											<th>详细地址</th>
											<th>行业</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($companys as $company)
										<tr>
											<td>{{$company['chinesename']}}</td>
											<td>{{$company['englishname']}}</td>
											<td>{{$company['city']}}</td>
											<td>{{$company['location']}}</td>
											<td>{{$company['industry']}}</td>
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

							<form action="#" class="form-horizontal">
								<h3 class="form-section">公司信息</h3>

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">中文名称</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="阿里巴巴">

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">English Name</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="Alibaba">

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

												<select class="m-wrap span12">

													<option value="1">上海</option>
													<option value="2">北京</option>
													<option value="3">广州</option>
													<option value="4">深圳</option>

												</select>

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">详细地址</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="上海...">

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

												<select class="m-wrap span12">

													<option value="1">互联网/移动互联网</option>
													<option value="2">游戏</option>
													<option value="3">传统IT</option>
													<option value="4">金融互联网</option>

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

												<input type="text" class="m-wrap span12" placeholder="张三">

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">English Name</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="Justin Zhang">

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

												<input type="text" class="m-wrap span12" placeholder="">

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">固定电话</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="">

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

												<div class="input-prepend"><span class="add-on">@</span><input class="m-wrap " type="text" placeholder="Email Address">

												</div>

											</div>
										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">QQ</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="">
											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								<h3 class="form-section">合同信息</h3>

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">开始时间</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="张三">

											</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">截止时间</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="Justin Zhang">

											</div>

										</div>

									</div>

									<!--/span-->

								</div>

								<!--/row-->

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">附件上传</label>

											<div class="controls">

												<input type="text" class="m-wrap span12" placeholder="">

											</div>

										</div>

									</div>



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

@section("scripts")

<script type="text/javascript" src="/bootstrap2/media/js/form-components.js"></script>
<script type="text/javascript" src="/bootstrap2/media/js/bootstrap-datepicker.js"></script>

<script>

		jQuery(document).ready(function() {       

		   if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl : App.isRTL()
            });
        }

		});

	</script>
@stop