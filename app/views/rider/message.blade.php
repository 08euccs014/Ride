@extends('layouts/main')
@section('content')

<div class="row">

	<h1>Messages</h1>
	<hr />
	
	<div class="gap-top-20 col-sm-12">
		@if($messages)
			@foreach($messages as $msg)
			<p class="gap-top-10">
				From : <strong>{{ $msg->sender->firstname}} {{ $msg->sender->lastname }}</strong>
				<p>
					{{ $msg->content }}
				</p>
			</p>
			@endforeach
			
		@else
			<h3>Right now, you don't have any mesasge.</h3>
		@endif
	</div>
	
</div>

@stop