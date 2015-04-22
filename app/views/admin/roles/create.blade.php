@extends('mwork.layouts.default')

{{-- Content --}}
@section('content')
	{{-- Create Role Form --}}
	<div class="page-header">
		<h3>
			权限组设置
		</h3>
	</div>
	<form id="form_role" class="form-horizontal" method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
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
        	<select id="permission_select">
            @foreach ($permissions as $permission)
           	<option value=""> </option>
                <input class="control-label" type="hidden" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="0" />
                <input class="form-control" type="checkbox" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="1"{{{ (isset($permission['checked']) && $permission['checked'] == true ? ' checked="checked"' : '')}}} />
                {{{ $permission['display_name'] }}}
            
            @endforeach
            </select>
        </div>

		<!-- Form Actions -->
		<div class="form-group">
            <div class="col-md-offset-2 col-md-10">
            	@if ($mode == 'edit')
            	<input type="hidden" name="mode" value="edit" />
				<button type="submit" class="btn btn-success" id="role_update">修改</button>
				@endif
				@if ($mode == 'create')
				<input type="hidden" name="mode" value="create" />
				<button type="submit" class="btn btn-success" id="role_create">创建</button>
				@endif
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
		});

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

		$("#role_update").click(function(){
			$.ajax({
				type: "POST",
				url: "roles/update/" + id,  // current page
				data:$('#form_role').serialize(), // form data
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function (result) {
					RefreshRoleTable(result);
				}
			});
		});

		$("#role_create").click(function(){
			$.ajax({
				type: "POST",
				url: "roles/create/",  // current page
				data:$('#form_role').serialize(), // form data
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				success: function (result) {
					RefreshRoleTable(result);
				}
			});
		});

		function RefreshRoleTable(data){
			alert(1);
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
					//$("#name").text = result;
				}
			});
		}
	</script>
@stop