@extends('mwork.layouts.default')
@section('csss')
@stop
@section('content')
    <div class="main">
    	<!-- BEGIN SAMPLE FORM PORTLET-->   

						<div class="portlet box grey">

							<div class="portlet-title">

								<div class="caption"><i class="icon-reorder"></i>添加团队</div>

								<div class="actions">

									<a href="/team" class="btn blue"><i class="icon-pencil"></i> 取消添加</a>

								</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form method="POST" class="form-horizontal" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
									<h3 class="form-section">基本信息</h3>

									<div class="control-group">

										<label class="control-label">团队名称</label>

										<div class="controls">

											<input type="text" class="span6 m-wrap" name="team_name">

											<span class="help-inline"></span>

										</div>

									</div>
									
									<h3 class="form-section">成员</h3>
									<div class="control-group">
										<label class="control-label">Lead</label>

										<div class="controls">

											<select class="span6 m-wrap" data-placeholder="Choose a Category" tabindex="1" name="lead_name">

												<option value="">Select...</option>
												@foreach ($users as $user)

													<option value="{{$user['username']}}">{{$user['username']}}</option>

												@endforeach


											</select>

										</div>
										

									</div>

									<div class="control-group">

										<label class="control-label">其他成员</label>

										<div class="controls">

											<input type="hidden" id="member_names" name="member_names" class="span6 select2" value="">

										</div>

									</div>
							
									
									<div class="form-actions">

										<button type="submit" class="btn blue">增加</button>

										<button type="button" class="btn" onclick='location.href="/team"'>取消</button>                            

									</div>
									

								</form>

								<!-- END FORM-->       

							</div>

						</div>

						<!-- END SAMPLE FORM PORTLET-->
@stop

@section("scripts")

<script type="text/javascript" src="/bootstrap2/media/js/form-components.js"></script>

<script>

		jQuery(document).ready(function() {       

		   if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl : App.isRTL()
            });

            $("#member_names").select2({
            	tags: [
            	@foreach ($users as $user)

					"{{$user['username']}}",

				@endforeach
            	
            	]
        	});
        }

		});

	</script>
@stop