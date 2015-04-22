@extends('mwork.layouts.default')

{{-- Content --}}
@section('content')
	{{-- Create Role Form --}}
	<div class="page-header">
		<h3>
			权限组设置
		</h3>
	</div>
	<form id="form_role" class="form-horizontal"  method="POST" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<input type="hidden" id="role_id" value="" />
		<!-- ./ csrf token -->
		<!-- Name -->
		<div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
			组名称:
			<br>
            <div class="col-md-10">
				<input class="form-control" type="text" name="name" id="group_name" value="{{{ Input::old('name') }}}" />
				{{ $errors->first('name', '<span class="help-inline">:message</span>') }}
            </div>
		</div>
		<!-- ./ name -->
	
		<br>
		权限:
		<br>
        <div class="form-group">
        	@foreach ($permissions as $permission)
					<label>
						<input type="hidden" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="0" />
						<input type="checkbox" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="1"{{{ (isset($permission['checked']) && $permission['checked'] == true ? ' checked="checked"' : '')}}} />
						{{{ $permission['display_name'] }}}
					</label>
					@endforeach

        </div>

		<!-- Form Actions -->
		<div class="form-group">
            <div class="col-md-offset-2 col-md-10">
            	<input type="hidden" name="role_mode_val" value="create" />
				<button type="submit" class="btn btn-success" id="role_create" >创建</button>
				<button type="submit" class="btn btn-success" id="role_edit" disabled="disabled">修改</button>
            </div>
		</div>
		<!-- ./ form actions -->
	</form>

	{{-- Role list --}}
	<div class="page-header">
		<h3>
			权限组列表
		</h3>
	</div>

	<table id="roles" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-6">{{{ Lang::get('admin/roles/table.name') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/roles/table.users') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/roles/table.created_at') }}}</th>
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
				oTable = $('#roles').dataTable( {
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sLengthMenu": "每页 _MENU_"
				},
				"bProcessing": false,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('roles/datas') }}"
			});

			$("#form_role").bind("submit", function(){
				ajaxSubmit(this, function(result){
					// result
				});
			});
		});

		function ajaxSubmit(fm, cb){
			$.ajax({
				type:fm.method,
				url:fm.url,
				data:getFormJson(fm), // form data
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

		function deleteRole(id){
			if(confirm('确定要删除用户权限组吗（无法恢复）?')){
				$.ajax({
					type: "POST",
					url: "roles/delete/" + id,  // current page
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function (result) {
						RefreshRoleTable(result);
					}
				});
			}
		}


		function editRole(id){
			// set data
			$.ajax({
				type: "GET",
				url: "/manage/role/" + id,  // current page
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function (result) {
					$("#group_name").val(result['name']);
					$("#role_edit").removeAttr("disabled");
					$("#role_create").attr("disabled","disabled");
					$("#role_mode_val").val("edit");
					$("#role_id").val(id);
					$("input").prop("checked", false);
					for(var i = 0; i < result['permissionIds'].length; ++i){
						$("#permissions[" + result['permissionIds'][i] + "]").prop('checked',true);
					}
					$.uniform.update();
				}
			});
		}
	</script>
@stop