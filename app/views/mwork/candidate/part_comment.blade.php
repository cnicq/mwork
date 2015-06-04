
@foreach ($cacomments as $cacomment)
		
		<address>
		<strong>
			{{$cacomment->auth_id}}   [{{$cacomment->updated_at}}]
		</strong>
		<br>
		{{$cacomment->content}}
		</address>
		
@endforeach

