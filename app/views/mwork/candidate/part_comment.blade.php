
@foreach ($cacomments as $cacomment)
		
		<address>
		<strong>
			{{User::GetUserNameById($cacomment->auth_id)}} 
		</strong>
		<br>
		[{{$cacomment->updated_at}}] {{$cacomment->content}}
		</address>
		
@endforeach

