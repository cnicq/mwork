@extends('mwork.layouts.default')
@section('csss')
<link rel="stylesheet" type="text/css" href="/bootstrap2/media/css/profile.css" />
@stop
@section('content')
  <!-- BEGIN PAGE CONTENT-->
<div class="tabbable tabbable-custom tabbable-full-width" id="myTab">
	<ul class="nav nav-tabs">

		<li class="@if($tab == 'profile') active @endif"><a href="/user/profile/{{$user->id}}" >基本信息</a></li>
		<li class="@if($tab == 'project') active @endif"><a href="/user/project/{{$user->id}}" >参与项目</a></li>
		<li class="@if($tab == 'kpi') active @endif"><a href="/user/kpi/{{$user->id}}" >KPI考核</a></li>

	</ul>

	<div class="tab-content">

		<div class="tab-pane row-fluid @if($tab == 'profile') active @endif" id="tab_1_1">
			@include('mwork.user.part_profile')
		</div>
		<div class="tab-pane row-fluid @if($tab == 'project') active @endif" id="tab_1_2">
			@include('mwork.user.part_project')
		
		</div>
		<div class="tab-pane row-fluid @if($tab == 'kpi') active @endif" id="tab_1_3" >
			@include('mwork.user.part_kpi')
		</div>
		
	</div>

<!-- END PAGE CONTENT-->
</div>
				
@stop

@section("scripts")


@stop