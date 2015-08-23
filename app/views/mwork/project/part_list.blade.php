@if (isset($projects))
<table class="table table-striped table-bordered table-hover table-full-width" id="sample_2">
	<thead>
		<tr>
			<th>项目ID</th>
			<th>状态</th>
			<th>客户</th>
			<th>职位</th>
			<th>所在城市</th>
			<th>时间</th>
			<th>负责人</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projects as $project)
		<tr>
			<td>{{$project->id}}</td>
			<td>
				{{Datavalue::getvalue('projstate',$project->projstate_name)->text}}
			</td>
			
			<td><a href='/client'>
				{{Company::find(Client::find($project->client_id)->company_id)->chinesename}} | 
				{{Company::find(Client::find($project->client_id)->company_id)->englishname}}
			</a></td>
			<td>{{Datavalue::getvalue('position',$project->position_name)->text}}</td>
			<td>{{Datavalue::getvalue('city',$project->city_name)->text}}</td>
			<td>{{$project->starttime}} - {{$project->endtime}}</td>
			<td>{{User::find($project->owner_user_id)->username}}</td>
			<td>
				@if(isset($caId))
					@if (Candidate::InProject($project->id, $caId) == false)
						<a href="/candidate/addProject/{{$project->id}}/{{$caId}}">加入项目</a>
					@else
						已加入
					@endif
				@endif

				<a href="/project/detail/{{$project->id}}" target="_blank">详细</a>

			</td>
		</tr>
		@endforeach
	</tfoot>
	</tbody>
</table>
<ul class="pagination">
{{$projects->links()}}
</ul>

@endif

