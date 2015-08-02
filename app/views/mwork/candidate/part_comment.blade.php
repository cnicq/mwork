
@foreach ($cacomments as $cacomment)
		
		<address>
		<strong>
			[{{$cacomment->created_at}}] {{User::GetUserNameById($cacomment->auth_id)}} 
		</strong>
		<br>
		
		{{Datavalue::getvalue('castatus',$cacomment->castatus)->text}}
		 - {{$cacomment->content}}
		</address>
		
@endforeach

