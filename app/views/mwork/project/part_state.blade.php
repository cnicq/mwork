进度<span class="badge badge-info">{{Project::GetFinishHeadCount($project->proj_id)}}/{{$project->head_count}}</span>
状态<span class="badge badge-info">{{Datavalue::getvalue('projstate',$project->projstate_name)->text}}</span>
<select id='sel_proj_state'>
@if ($values = Datavalue::getValues('projstate')) 
	@foreach ($values as $value)
	<option value='{{$value->name}}' @if($project->projstate_name == $value->name)  selected @endif>{{$value->text}}</option>
	@endforeach
@endif
</select>
<button onclick='onChangeProjState()'>更改状态</button>