
<table class="table table-striped table-bordered table-hover table-full-width" id="candidate_list2">
<thead>
	<tr>
		<th style="display:none;"></th>
		<th>中文名 / 英文名</th>
		<th>性别</th>
		<th>所在地</th>
		<th>电话</th>
		<th>所在公司</th>
		<th>职位</th>
	</tr>

</thead>

<tbody>
@if (isset($candidates))
	@foreach ($candidates as $candidate)
	<tr>
		<td style="display:none;">{{$candidate['id']}}</td>
		<td>{{$candidate['chinesename']}} / {{$candidate['englishname']}}</td>
		<td>{{$candidate['gender']}}</td>
		<td>{{$candidate['location']}}</td>
		<td>{{$candidate['mobile1']}} {{$candidate['mobile2']}} </td>
		<td>{{$candidate['company']}}</td>
		<td>{{$candidate['position']}}</td>
		
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

