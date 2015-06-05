当前状态:{{$curStep['text']}} , 更改状态
<select id='step_value'>
@foreach ($steps as $step)
@if ($step->name != '$curStep')
	<option value='{{$step->name}}'>{{$step['text']}}</option>		
@endif
@endforeach
</select>
说明:
<input id='update_step_input'> 
<button id='update_step_button' onclick='onClickUpdateStep()'>修改</button>

<table class="table table-striped table-bordered table-hover table-full-width" id="">
	<thead>
		<tr>
			<th>状态</th>
			<th>修改人</th>
			<th>修改时间</th>
			<th>说明</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projectinfos as $projectinfo)
		<tr>
			<td>{{ Datavalue::getValue('step', $projectinfo['step'])->text}}</td>
			<td>{{ User::find($projectinfo['auth_id'])->first()->username}}</td>
			<td>{{$projectinfo['updated_at']}}</td>
			<td>{{$projectinfo['content']}}</td>
		</tr>
		@endforeach

	</tbody>
</table>

