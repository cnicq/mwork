
@if(Auth::user()->IsAmin())
	@include('mwork.layouts.menu_admin')
@elseif(Auth::user()->IsLead())
	@include('mwork.layouts.menu_lead')
@else
	@include('mwork.layouts.menu_member')
@endif