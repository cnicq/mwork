
@foreach ($cacomments as $cacomment)
		
		<address>
		<strong>
			{{User::GetUserNameById($cacomment->auth_id)}} 
		</strong>
		<br>
		[{{$cacomment->created_at}}] {{$cacomment->content}}
		</address>
		
@endforeach

