@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/datepicker.css" />
@stop
@section('content')
    <div class="main">
    	<!-- BEGIN SAMPLE FORM PORTLET-->   

						<div class="portlet box grey">

							<div class="portlet-title">

								<div class="caption"><i class="icon-reorder"></i>添加项目</div>

								<div class="actions">

									<a href="/project" class="btn blue"><i class="icon-pencil"></i> 取消添加</a>

								</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form action="#" class="form-horizontal" enctype="multipart/form-data" method="POST">
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
									<h3 class="form-section">客户信息</h3>

									<div class="control-group">

										<label class="control-label">客户</label>

										<div class="controls">

											<select class="m-wrap span6" id='client_id' name='client_id'>
												<option> 请选择...</option>
												@foreach ($clients as $client)
													<option value='{{$client->id}}' linkman='{{$client->linkman_chinesename}}|{{$client->linkman_englishname}}'> {{$client->chinesename}} </option>
												@endforeach
												</select>

												<button class="btn purple" onclick='location.href="/clients"'>新增 <i class="m-icon-swapright m-icon-white"></i></button>
												
										

										</div>
									</div>

									<div class="control-group">
										<label class="control-label span6">联系人</label>

										<div class="controls">
											
											<input type="text"  placeholder="" disabled name='linkman' id='linkman'>

							详细

										</div>

									</div>
									<h3 class="form-section">项目内容</h3>
									<div class="control-group">
										<div class="control-group">
										<label class="control-label">职位名称(position)</label>

										<div class="controls">
											<select class="m-wrap span6" id='position_name' name='position_name'>
												<option> 请选择...</option>
												@foreach ($positions as $position)
													<option value='{{$position->name}}'> {{$position->text}} </option>
												@endforeach
												</select>
											<button class="btn purple" onclick='location.href="/manage/datavalues"'>新增 <i class="m-icon-swapright m-icon-white"></i></button>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">需求数量(Head Count)</label>

										<div class="controls">

											<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" id='head_count' name='head_count'>

												<option value="1" selected>1</option>

												<option value="2" >2</option>

												<option value="3" >3</option>

												<option value="4" >4</option>

												<option value="5" >5</option>

												<option value="6" >6</option>

												<option value="7" >7</option>

												<option value="8" >8</option>

											</select>

										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label">工作城市</label>

										<div class="controls">

						
											<select class="m-wrap span6" id='city_name' name='city_name'>
												<option> 请选择...</option>
												@foreach ($citys as $city)
													<option value='{{$city->name}}'> {{$city->text}} </option>
												@endforeach
												</select>


										</div>
									</div>
									<div class="control-group">
										<label class="control-label">具体地址</label>

										<div class="controls">

												<input class="m-wrap span6" type="text" id='location' name='location'>

										</div>
									</div>

									<div class="control-group">
										<label class="control-label">年收入</label>

										<div class="controls">

											<div class="input-prepend input-append ">

												<span class="add-on">RMB</span><input class="m-wrap" type="text" id='income' name='income'>

											</div>

										</div>
									</div>
									<div class="control-group">
									<label class="control-label">项目说明</label>
											<div class="controls">

											<textarea class="span6 m-wrap" rows="3" id='desc' name='desc'></textarea>
               

										</div>
									</div>

									</div>
									<h3 class="form-section">其他</h3>
									<div class="control-group">

										<label class="control-label">项目起始时间</label>

										<div class="controls">

											<div class="input-append date date-picker" ddata-date-format="dd-mm-yyyy" data-date-viewmode="years">

												<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" value="" id='starttime' name='starttime'><span class="add-on"><i class="icon-calendar"></i></span>

											</div>

										</div>
										</div>
										<div class="control-group">
										<label class="control-label">项目截止时间</label>

										<div class="controls">

											<div class="input-append date date-picker" ddata-date-format="dd-mm-yyyy" data-date-viewmode="years">

												<input class="m-wrap m-ctrl-medium date-picker" readonly="" size="16" type="text" value="" id='endtime' name='endtime'><span class="add-on"><i class="icon-calendar"></i></span>

											</div>

										</div>
									</div>
									<div class="control-group">

										<div class="control-group">

										<label class="control-label">项目负责团队</label>

										<div class="controls">

											<select class="m-wrap span6" id='team_id' name='team_id'>
												<option> 请选择...</option>
												@foreach ($teams as $team)
													<option value='{{$team->id}}'> {{$team->name}} </option>
												@endforeach
												</select>

											<button class="btn purple" onclick='location.href="/manage/teams"'>新增 <i class="m-icon-swapright m-icon-white"></i></button>
										</div>
										</div>

										<div class="control-group">

										<label class="control-label">项目负责人</label>

										<div class="controls">

											<select class="m-wrap span6" id='owner_user_id' name='owner_user_id'>
												<option> 请选择...</option>
												@foreach ($users as $user)
													<option value='{{$user->id}}'> {{$user->username}} </option>
												@endforeach
												</select>

											<button class="btn purple" onclick='location.href="/manage/users"'>新增 <i class="m-icon-swapright m-icon-white"></i></button>
										</div>
										</div>

									</div>
									<div class="form-actions">

										<button type="submit" class="btn blue">提交</button>

										<button type="button" class="btn" onclick='location.href="/project"'>取消</button>                            

									</div>
									

								</form>

								<!-- END FORM-->       

							</div>

						</div>

						<!-- END SAMPLE FORM PORTLET-->
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

            $('#client_id').change(function(){
        	$('#linkman').val($("#client_id").find("option:selected").attr('linkman'));
        	});
        }

		});

	</script>
@stop