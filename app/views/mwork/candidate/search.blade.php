<action="#" class="form-horizontal"  method="POST" autocomplete="off" id='form_search_candidate' name='form_search_candidate'>
	<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	<!-- ./ csrf token -->
	<div class="row-fluid">

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">关键字(空格隔开)</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='chinesename' name='chinesename'>

				</div>

			</div>

		</div>

		<!--/span-->

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">中文名</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='englishname' name='englishname'> 

				</div>

			</div>

		</div>

		<!--/span-->
		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">英文名</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='englishname' name='englishname'> 

				</div>

			</div>

		</div>

		<!--/span-->

	</div>

	<!--/row-->
	<div class="row-fluid">

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">所在公司</label>

				<div class="controls">

							<select class="m-wrap " id='company' name='company'>
								<option>请选择...</option>
								@foreach ($companys as $company)
								<option value='{{$company->id}}' linkman='{{$company->linkman_chinesename}}|{{$company->linkman_englishname}}'> {{$company->chinesename}} </option>
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
							<option> 请选择...</option>
							@foreach ($citys as $city)
								<option value='{{$city->name}}'> {{$city->text}} </option>
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
							<option> 请选择...</option>
							@foreach ($positions as $position)
								<option value='{{$position->name}}'> {{$position->text}} </option>
							@endforeach
							</select>
						</div>

			</div>

		</div>

		<!--/span-->

	</div>

	<!--/row-->
	<div class="row-fluid">

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">移动电话</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='chinesename' name='chinesename'>

				</div>

			</div>

		</div>

		<!--/span-->

		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">固定电话</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='englishname' name='englishname'> 

				</div>

			</div>

		</div>

		<!--/span-->
		<div class="span4 ">

			<div class="control-group">

				<label class="control-label">简历编号</label>

				<div class="controls">

					<input type="text" class="m-wrap" placeholder="" id='englishname' name='englishname'> 

				</div>

			</div>

		</div>

		<!--/span-->

	</div>

	<!--/row-->
<div class="form-actions">

	<button type="submit" class="btn blue" id='search_submit'><i class="icon-ok"></i>搜索</button>

</div>
</form>

<div id='candidate_list'> </div>

<script type="text/javascript">
jQuery(document).ready(function() {
$('#search_submit').bind('click', function(event) {
     $('#form_search_candidate').submit();
     event.preventDefault();
 });
$('#form_search_candidate').bind("submit", function(event){
		event.preventDefault();
		urlTo = "/candidate/search";
		$.ajax({
			type:'POST',
			url:urlTo,
			data:getFormJson(this),
			success: function(d){
				$('#candidate_list').html(d);

				TableAdvanced.init1();
			}
		});
	});
});

</script>