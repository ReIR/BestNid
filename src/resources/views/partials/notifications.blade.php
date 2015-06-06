<div class="col-md-12">
	@if(Session::has('success'))
		<div class="alert alert-success dismissable" role="alert">
			<span>{{Session::get('success')}}</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  	<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if( Session::has('error') || Session::has('errors') )
		<div class="alert alert-danger dismissable" role="alert">
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
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	<script type="text/javascript">
		jQuery(function($){

			// Dismiss alert
			if ($('.alert').hasClass('dismissable')) {
				setTimeout(function(){
					$('.alert').fadeOut();
				}, 5000);

				$('.alert').click(function(){
					$('.alert').fadeOut();
				});
			}

		});
	</script>
</div>
