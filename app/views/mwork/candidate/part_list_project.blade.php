
<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
<thead>
	<tr>
		<th>中文名</th>
		<th>英文名</th>
		<th>性别</th>
		<th>所在地</th>
		<th>电话</th>
		<th>所在公司</th>
		<th>职位</th>
		<th>操作</th>
		<th style="display:none;"></th>
		<th style="display:none;"></th>
		<th style="display:none;"></th>
		<th style="display:none;"></th>
		<th style="display:none;"></th>
		<th style="display:none;"></th>
	</tr>

</thead>

<tbody>
@if (isset($candidates))
	@foreach ($candidates as $candidate)
	<tr>
		<td>{{$candidate['chinesename']}}</td>
		<td>{{$candidate['englishname']}}</td>
		<td>{{$candidate['gender']}}</td>
		<td>{{$candidate['location']}}</td>
		<td>{{$candidate['mobile']}}</td>
		<td>{{$candidate['company']}}</td>
		<td>{{$candidate['position']}}</td>
		<td>
			<button val='{{$candidate['id']}}' name='candidate_select' id='candidate_select' onclick='onselect' disabled>选择</button>
			<button val='{{$candidate['id']}}' name='candidate_cancel' id='candidate_cancel' onclick='oncancel'>取消</button>
		</td>
		<td style="display:none;">{{$candidate['materialstatus']}}</td>
		<td style="display:none;">{{$candidate['hometown']}}</td>
		<td style="display:none;">{{$candidate['status']}}</td>
		<td style="display:none;">{{$candidate['resumes']}}</td>
		<td style="display:none;">{{$candidate['notes']}}</td>
		<td style="display:none;">{{$candidate['label']}}</td>
		
	</tr>

	@endforeach
	
@endif

</tbody>
</table>
<ul class="pagination">
@if (isset($candidates))
{{$candidates->links()}}
@endif
</ul>

<script type="text/javascript">
// for project page
function onclick(){
	$.ajax({
		type: "GET",
		url: "/project/select/" + id,  // current page
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		success: function (result) {
			
		}
	});
}

function oncancel(){
	
}

</script>