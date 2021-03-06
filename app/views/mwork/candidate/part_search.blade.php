<form action="#" class="form-horizontal"  method="POST" autocomplete="off" id='form_search_candidate' name='form_search_candidate' >
	<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<input type="hidden" id="projId" value="@if (isset($projId)){{$projId}}@endif" />
	<!-- ./ csrf token -->
	

	<!--/row-->
	<div class="row-fluid">

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">所在公司</label>

				<div class="controls">

							<select class="m-wrap " id='company' name='company'>
								<option value=''>请选择...</option>
								@foreach ($companys as $company)
								<option value='{{$company->linkman_chinesename}}' linkman='{{$company->linkman_chinesename}}|{{$company->linkman_englishname}}'> {{$company->chinesename}} </option>
								@endforeach
							</select>
						</div>
			</div>

		</div>

		<!--/span-->

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">所在城市</label>

				<div class="controls">

							<select class="m-wrap" id='city' name='city'>
							<option value=''> 请选择...</option>
							@foreach ($citys as $city)
								<option value='{{$city->text}}'> {{$city->text}} </option>
							@endforeach
							</select>
						
						</div>

			</div>

		</div>

		<!--/span-->
		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">当前职位</label>

				<div class="controls">

							<select class="m-wrap" id='position' name='position'>
							<option value=''> 请选择...</option>
							@foreach ($positions as $position)
								<option value='{{$position->text}}'> {{$position->text}} </option>
							@endforeach
							</select>
						</div>

			</div>

		</div>

		<!--/span-->

	</div>

	<div class="row-fluid">

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">关键字(用空格分开)</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='keywords' name='keywords'>

				</div>

			</div>

		</div>

	</div>
	
<div class="form-actions">
	<button type="submit" class="btn blue" id='search_submit'><i class="icon-ok"></i>搜索</button>
</div>
</form>

<div id='candidate_list'></div>

<script type="text/javascript">

var clickDetailFunc = function(caId, cb){
	var urlTo = "/candidate/detail/" + caId + '/' + $('#projId').val();
	
	$.ajax({
            type: "GET",
            url: urlTo,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (result) {
                cb(result);
            }
        });  
};

var urlTo = '/candidate/search/{{$mode}}';
jQuery(document).ready(function() {
	$('#search_submit').bind('click', function(event) {
		 $("#form_search_candidate").attr("action", urlTo);  
	     $('#form_search_candidate').submit();
	     event.preventDefault();
	 });

	$('#form_search_candidate').bind("submit", function(event){
		event.preventDefault();
		$.ajax({
			type:'POST',
			url:urlTo,
			data:getFormJson(this),
			success: function(d){
				$('#candidate_list').html(d);
				TableAdvanced.initDetailTable('candidate_list2',clickDetailFunc);
			}
		});
	});
	$('#search_submit').click();
});

</script>