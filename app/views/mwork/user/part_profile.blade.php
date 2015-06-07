@if ($tab == 'profile')

	<!-- BEGIN FORM : position manange-->

		<form action="#" class="form-horizontal" id="form_user" method="POST" autocomplete="off">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<input type="hidden" id="user_id" value="" />
			<!-- ./ csrf token -->
			@if (isset($error) && $error != '')
			<div class="alert alert-error" id= "error_div" >
				<button class="close" data-dismiss="alert"></button>
				<strong>提示!</strong> <p id='error_info'>{{$error}}</p>
			</div>
			@endif 
			<h3 class="form-section">基本信息</h3>

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">用户名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" name="username" id="username" value='{{$user->username}}' disabled> 

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

							<label class="control-label">邮箱</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id="email" name="email" value="{{$user->email}}">

						</div>
					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">密码</label>

						<div class="controls">

							<input type="password" class="m-wrap span12" placeholder="" value="mapping" id="password" name="password" value="{{{ Input::old('password') }}}">

						</div>

					

					</div>

				</div>

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">重复密码</label>

						<div class="controls">

							<input type="password" class="m-wrap span12" placeholder="" value="mapping" id="password_confirmation" name="password_confirmation" value="{{{ Input::old('password') }}}">

						</div>

					

					</div>

				</div>

				<!--/span-->
				
			</div>
			
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">中文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" name="chinesename" id="chinesename" value='{{$user->chinesename}}'> 

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

							<label class="control-label">英文名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id="englishname" name="englishname" value="{{$user->englishname}}">

						</div>
					</div>

				</div>

				<!--/span-->

			</div>

			<div class="form-actions">
				<input type="hidden" id="user_mode_val" value="create" />
				<button type="submit" class="btn btn-success" id="user_edit" >修改</button>
			</div>
		</form>
			<!--/row-->
			@if (isset($kpi))
			
			<h3 class="form-section">KPI考核</h3>

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">每日推荐数量</label>

						<div class="controls">

							<input type="text" class="m-wrap span6" placeholder="" value='{{$kpi->recommend}}' disabled>

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

							<label class="control-label">每日跟进(备注)数量</label>

						<div class="controls">

							<input type="text" class="m-wrap span6" placeholder="" value='{{$kpi->note}}' disabled>

						</div>
					</div>

				</div>

				<!--/span-->

			</div>


			<!--/row-->
			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">每日简历录入</label>

						<div class="controls">

							<input type="text" class="m-wrap span6" placeholder="" value='{{$kpi->resume}}' disabled>

						</div>

					

					</div>

				</div>

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">每日Cold Call</label>

						<div class="controls">

							<input type="text" class="m-wrap span6" placeholder="" value='{{$kpi->coldecall}}' disabled>

						</div>

					

					</div>

				</div>

				<!--/span-->
				
			</div>
			@endif

		<!-- END FORM -->   
@endif