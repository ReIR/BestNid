<div class="col-md-9">
	@if(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<span>{{Session::get('success')}}</span>
	</div>
	@endif

	@if( Session::has('error') || Session::has('errors') )
		<div class="alert alert-danger" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span>
			@if ( Session::has('errors'))
				<ul>
					@foreach (Session::get('errors') as $message)
						<li>{{$message}}</li>
					@endforeach
				</ul>
			@endif

			@if ( Session::has('error'))
				{{Session::get('error')}}
			@endif
		</div>
	@endif
</div>
