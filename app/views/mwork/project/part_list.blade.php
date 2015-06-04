@if (isset($projects))
<table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
	<thead>
		<tr>
			<th>项目ID</th>
			<th>客户</th>
			<th>职位</th>
			<th>所在城市</th>
			<th>起始时间</th>
			<th>结束时间</th>
			<th>负责人</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projects as $project)
		<tr>
			<td>{{$project['project_id']}}</td>
			<td>{{$project['client_id']}}</td>
			<td>{{$project['position_name']}}</td>
			<td>{{$project['city_name']}}</td>
			<td>{{$project['starttime']}}</td>
			<td>{{$project['endtime']}}</td>
			<td>{{$project['owner_user_id']}}</td>
			<td><a href="/project_{{$project['project_id']}}">详细</a></td>
		</tr>
		@endforeach
	</tfoot>
	</tbody>
</table>
<ul class="pagination">
{{$projects->links()}}
</ul>

@endif

