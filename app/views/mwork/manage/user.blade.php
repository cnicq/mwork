@extends('mwork.layouts.default')

@section('content')

<div class="portlet box green">

	<div class="portlet-title">

		<div class="caption"><i class="icon-reorder"></i>用户管理</div>

		<div class="tools">

			<a href="javascript:;" class="collapse"></a>

			<a href="#portlet-config" data-toggle="modal" class="config"></a>

			<a href="javascript:;" class="reload"></a>

			<a href="javascript:;" class="remove"></a>

		</div>

	</div>

	<div class="portlet-body form">

		<!-- BEGIN FORM : position manange-->

		<form action="#" class="form-horizontal" id="form_user" method="POST" autocomplete="off">
			<!-- CSRF Token -->
			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
			<input type="hidden" id="user_id" value="" />
			<!-- ./ csrf token -->
			<h3 class="form-section">新增</h3>

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">用户名</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" name="username" id="username">

						</div>

					</div>

				</div>

				<!--/span-->

				<div class="span6 ">

					<div class="control-group">

							<label class="control-label">邮箱</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" id="email" name="email" value="{{{ Input::old('email') }}}">

						</div>
					</div>

				</div>

				<!--/span-->

			</div>

			<!--/row-->

			<div class="row-fluid">

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">初始密码</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" value="mapping" id="password" name="password" value="{{{ Input::old('password') }}}">

						</div>

					

					</div>

				</div>

				<div class="span6 ">

					<div class="control-group">

						<label class="control-label">重复密码</label>

						<div class="controls">

							<input type="text" class="m-wrap span12" placeholder="" value="mapping" id="password_confirmation" name="password_confirmation" value="{{{ Input::old('password') }}}">

						</div>

					

					</div>

				</div>

				<!--/span-->
				
			</div>
			
			<div class="row-fluid">
				<div class="span6 ">

					<div class="control-group">
						<label class="control-label">是否激活</label>
						<div class="controls">
		                      @if ($mode == 'create')
							<select class="form-control" name="confirm" id="confirm">
								<option value="1"{{{ (Input::old('confirm', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
								<option value="0"{{{ (Input::old('confirm', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
							</select>
							@else
								<select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
									<option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
									<option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
								</select>
							@endif
							{{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}
						</div>
						
					</div>

				</div>

				<div class="span6 ">
						<label class="control-label">用户权限组</label>
						<div class="controls">
			                <select class="form-control" name="roles[]" id="roles[]" multiple>
			                        @foreach ($roles as $role)
										@if ($mode == 'create')
			                        		<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
			                        	@else
											<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
										@endif
			                        @endforeach
							</select>
						</div>

						
				</div>
			</div>
			<!--/row-->
			<div class="form-actions">
				<input type="hidden" id="user_mode_val" value="create" />
				<button type="submit" class="btn btn-success" id="user_create" >创建</button>
				<button type="submit" class="btn btn-success" id="user_edit" disabled="disabled">修改</button>
			</div>
		</form>

		<!-- END FORM : position manage-->   
	</div>
</div>

{{-- user list --}}
	<div class="page-header">
		<h3>
			用户列表
		</h3>
	</div>

	<table id="users" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-6">{{{ Lang::get('admin/users/table.name') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
				oTable = $('#users').dataTable( {
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "每页 _MENU_"
				},
				"bProcessing": false,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('users/datas') }}"
			});

			$("#form_user").bind("submit", function(){
				event.preventDefault();
				if($("#user_mode_val").val() == 'edit'){
					ajaxSubmitEdit(this, function(result){
					// result
					RefreshDataTable(result);
					});
				}
				else{
					ajaxSubmitCreate(this, function(result){
					// result
					RefreshDataTable(result);
					});
				}
			});

		});

		function RefreshDataTable(result)
		{
			alert(result);
			oTable._fnAjaxUpdate();

			// clear form
			$("#user_create").removeAttr("disabled");
			$("#user_edit").attr("disabled","disabled");
			$(".checked").removeClass("checked");
			$("#form_user").each(function() {   
			  this.reset(); 
			});   
		}

		function ajaxSubmitEdit(fm, cb){
			urlTo = "{{ URL::route('post_user_edit', ['userId']) }}";
			urlTo = urlTo.replace('userId', $("#user_id").val());
			$.ajax({
				type:fm.method,
				url:urlTo,
				data:getFormJson(fm),
				success: cb
			});
		}

		function ajaxSubmitCreate(fm, cb){
			urlTo = "{{ URL::route('post_user_create')}}";
			$.ajax({
				type:fm.method,
				url:urlTo,
				data:getFormJson(fm),
				success: cb
			});
		}

		function getFormJson(frm) {
		    var o = {};
		    var a = $(frm).serializeArray();
		    $.each(a, function () {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
		            o[this.name].push(this.value || '');
		        } else {
		            o[this.name] = this.value || '';
		        }
		    });
		    return o;
		}

		function deleteUser(id){
			if(confirm('确定要删除用户吗（无法恢复）?')){
				event.preventDefault();
				$.ajax({
					type: "GET",
					url: "/manage/user/delete/" + id,  // current page
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function (result) {
						RefreshDataTable(result);
					}
				});
			}
		}

		function editUser(id){
			// set data
			$.ajax({
				type: "GET",
				url: "/manage/user/" + id,  // current page
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function (result) {
					var userData = result['userData'];
					alert(userData['confirmed']);
					$("#user_id").val(userData['id']);
					$("#username").val(userData['username']);
					$("#email").val(userData['email']);

					$("#user_edit").removeAttr("disabled");
					$("#user_create").attr("disabled","disabled");
					$("#user_mode_val").val("edit");
					$("#confirm").val(userData['confirmed']);
					$.uniform.update();
				}
			});
		}
	</script>
@stop