
<table class="table table-striped table-bordered table-hover table-full-width" id="project_candidate_list">
<thead>
	<tr>
		<th style="display:none;"></th>
		<th>中文名</th>
		<th>英文名</th>
		<th>性别</th>
		<th>所在地</th>
		<th>电话</th>
		<th>所在公司</th>
		<th>职位</th>
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
		<td style="display:none;">{{$candidate['id']}}</td>
		<td>{{$candidate['chinesename']}}</td>
		<td>{{$candidate['englishname']}}</td>
		<td>{{$candidate['gender']}}</td>
		<td>{{$candidate['location']}}</td>
		<td>{{$candidate['mobile']}}</td>
		<td>{{$candidate['company']}}</td>
		<td>{{$candidate['position']}}</td>
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

