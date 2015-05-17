@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/datepicker.css" />
@stop
@section('content')

<div class="tabbable tabbable-custom tabbable-full-width">
	<ul class="nav nav-tabs">

			<li class="active"><a href="#tab_1_1" data-toggle="tab">客户列表</a></li>

			<li><a href="#tab_1_2" data-toggle="tab">新增客户</a></li>

	</ul>

	<div class="tab-content">

			<div class="tab-pane row-fluid active" id="tab_1_1">
				<!-- BEGIN FORM : client list-->

		<div class="portlet-body">

			<table class="table table-striped table-bordered table-hover table-full-width" id="sample">
				<thead>
					<tr>
						<th>公司</th>
						<th>联系人</th>
						<th>Owner</th>
						<th>BD</th>
						<th>合同</th>
						<th>项目</th>
					</tr>
				</thead>
				<tbody>

					@foreach ($clients as $client)
					<tr>
						<td>{{$client['chinesename']}}</td>
						<td>{{$client['linkman_chinesename']}}|{{$client['linkman_englishname']}}</td>
						<td>{{$client['owner_username']}}</td>
						<td>{{$client['DB_username']}}</td>
						<td>{{$client['contract_path']}}</td>
						<td><a href='/project'>查看</></td>
					</tr>

					@endforeach
					
				</tfoot>

				</tbody>
			</table>
			<ul class="pagination">
				{{$clients->links()}}
			</ul>
			</div>

		<!-- END FORM : client list-->   

			</div>

			<div class="tab-pane row-fluid" id="tab_1_2">
				<!-- BEGIN FORM : client manange-->

		<form action="#" class="form-horizontal" method='POST'>
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<h3 class="form-section">基本信息</h3>
			<!--/row-->
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">公司</label> 

						<div class="controls">

							<select class="m-wrap " id='company' name='company'>
							@foreach ($companys as $company)
								<option value='{{$company->id}}' linkman='{{$company->linkman_chinesename}}|{{$company->linkman_englishname}}'> {{$company->chinesename}} </option>
							@endforeach
							</select>
							详细
						</div>


					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">联系人</label>

						<div class="controls">

							<input type="text"  placeholder="" disabled name='linkman' id='linkman'>

							详细
						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">Owner</label>

						<div class="controls">
							<select id='owner_user_id' name='owner_user_id'>
							@foreach ($users as $user)
								<option value='{{$user->id}}'> {{$user->username}} </option>
							@endforeach
						</select>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">BD</label>

						<div class="controls">
							<select id='BD_user_id' name='DB_user_id'>
							@foreach ($users as $user)
								<option value='{{$user->id}}'> {{$user->username}} </option>
							@endforeach
							</select>
						</div>

					</div>

				</div>

				<!--/span-->

			</div>

			<h3 class="form-section">合同信息</h3>

								<div class="row-fluid">

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">开始时间</label>
											<div class="controls">
											<div class="input-append date date-picker" ddata-date-format="dd-mm-yyyy" data-date-viewmode="years">

												<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" value="" name='contract_start' id='contract_start'><span class="add-on"><i class="icon-calendar"></i></span>

											</div>
										</div>

										</div>

									</div>

									<!--/span-->

									<div class="span6 ">

										<div class="control-group">

											<label class="control-label">截止时间</label>
											<div class="controls">
											<div class="input-append date date-picker" ddata-date-format="dd-mm-yyyy" data-date-viewmode="years">

												<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" value="" name='contract_end' id='contract_end'><span class="add-on"><i class="icon-calendar"></i></span>

											</div>
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

												<input type="text" class="m-wrap span12" placeholder="" name='contract_filePath' id='contract_filePath'>

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

		<!-- END FORM : client manage-->   
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

        $('#company').change(function(){
        	$('#linkman').val($("#company").find("option:selected").attr('linkman'));
        });

		});

	</script>
@stop