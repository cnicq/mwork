@extends('mwork.layouts.default')
@section('metas')
<meta name="_token" content="{{ csrf_token() }}"/>
@stop
{{-- Content --}}
@section('content')
	{{-- Create Role Form --}}

	<div class="tabbable tabbable-custom tabbable-full-width" id='myTab'>
		<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1_1" data-toggle="tab">权限组设置</a></li>

				<li><a href="#tab_1_2" data-toggle="tab">权限组列表</a></li>
		</ul>

		<div class="tab-content">

			<div class="tab-pane row-fluid active" id="tab_1_1">

				<form id="form_role" class="form-horizontal" method="POST" autocomplete="off">
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
						<input type="checkbox" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="1"{{{ (isset($permission['checked']) && $permission['checked'] == true ? ' checked="checked"' : '')}}} pid='{{{ $permission['id'] }}}'/>
						{{{ $permission['display_name'] }}}
					</label>
					@endforeach

		        </div>

				<!-- Form Actions -->
				<div class="form-group">
		            <div class="col-md-offset-2 col-md-10">
		            	<input type="hidden" id="role_mode_val" value="create" />
						<button type="submit" class="btn btn-success" id="role_create" >创建</button>
						<button type="submit" class="btn btn-success" id="role_edit" disabled="disabled">修改</button>
		            </div>
				</div>
				<!-- ./ form actions -->
			</form>
			</div>

			<div class="tab-pane row-fluid" id="tab_1_2">
				<table id="roles" class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="col-md-6">{{{ Lang::get('admin/roles/table.name') }}}</th>
						<th class="col-md-2">{{{ Lang::get('admin/roles/table.users') }}}</th>
						<th class="col-md-2">{{{ Lang::get('admin/roles/table.created_at') }}}</th>
						<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
					</tr>
				</thead>
		
		</table>
			</div>
		</div>
	</div>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		tabName = '';

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
				event.preventDefault();
				if($("#role_mode_val").val() == 'edit'){
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
			oTable._fnAjaxUpdate();

			// clear form
			$("#role_create").removeAttr("disabled");
			$("#role_edit").attr("disabled","disabled");
			$(".checked").removeClass("checked");
			$("#form_role").each(function() {   
			  this.reset(); 
			});  

			$('#myTab a[href="#' + tabName + '"]').tab('show');  
		}

		function ajaxSubmitEdit(fm, cb){
			tabName = 'tab_1_2';
			urlTo = "{{ URL::route('post_role_edit', ['roleId']) }}";
			urlTo = urlTo.replace('roleId', $("#role_id").val());
			$.ajax({
				type:fm.method,
				url:urlTo,//"/manage/role/edit/" + $("#role_id").val(),
				data:getFormJson(fm), // form data
				beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
				success: cb
			});
		}

		function ajaxSubmitCreate(fm, cb){
			tabName = 'tab_1_2';
			urlTo = "{{ URL::route('post_role_create')}}";
			$.ajax({
				type:fm.method,
				url:urlTo,//"/manage/role/create",
				data:getFormJson(fm), // form data
				beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                },
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
			tabName = 'tab_1_2';
			if(confirm('确定要删除用户权限组吗（无法恢复）?')){
				event.preventDefault();
				$.ajax({
					type: "GET",
					url: "/manage/role/delete/" + id,  // current page
					contentType: "application/json; charset=utf-8",
					dataType: "json",
					success: function (result) {
						RefreshDataTable(result);
					}
				});
			}
		}

		function editRole(id){
			tabName = 'tab_1_1';
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
					$("#form_role input:checkbox").each(function(){
						var val = $(this).attr('pid');
						for(i = 0; i < result['permissionIds'].length; ++i){
							if(result['permissionIds'][i] == val){
								$(this).prop('checked',true);
								break;
							}
						}
					});
					$.uniform.update();
				}
			});

			$('#myTab a[href="#' + tabName + '"]').tab('show');  
		}
	</script>
@stop