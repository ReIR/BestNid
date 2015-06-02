<html>
	<head>
		 <title>Bestnid - @yield('title')</title>
		 <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
		 <link rel="stylesheet" href="{{asset('css/bestnid.css')}}">
	</head>
	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
		      <!-- Brand and toggle get grouped for better mobile display -->
		      <div class="navbar-header">
		        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		          <span class="sr-only">Toggle navigation</span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </button>
		        <a class="navbar-brand" href="{{route('articles.index')}}">Bestnid</a>
		      </div>

		      <!-- Collect the nav links, forms, and other content for toggling -->
		      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

		        {!! Form::open(array('route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left')) !!}
		        	<div class="form-group">
		        		{!! Form::text('q', Request::input('q'), array('placeholder' => '', 'class' => 'form-control')) !!}
		        	</div>
		        	{!! Form::submit('buscar', array('class' => 'btn btn-default')) !!}
		        {!! Form::close() !!}


		        <ul class="nav navbar-nav navbar-right">
	        		<?php $route = Route::currentRouteName(); ?>
		        	@if (!Auth::check())
		          		<li>
			          		<a href="{{route('users.getLogin')}}" 
			          			class="{{($route == 'users.getLogin') ? 'active' : ''}}">
			          			Iniciar Sesión
			          		</a>
		          		</li>
		          		<li>
			          		<a href="{{route('users.create')}}"
			          			class="{{($route == 'users.create') ? 'active' : ''}}">
			          			Registrarse
			          		</a>
		          		</li>
		          	@else
		          		<li>
		          			<a href="{{route('dashboard.index')}}"
		          			class="{{($route == 'dashboard.index') ? 'active' : ''}}">Panel</a>
		          		</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->getFullName()}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{route('users.logout')}}">Cerrar Sesión</a>
								</li>
							</ul>
						</li>
		          	@endif
		        </ul>
		      </div><!-- /.navbar-collapse -->
		    </div><!-- /.container-fluid -->
		</nav>

    	<div class="container-fluid">
    		
    		@section('notifications')
    			@include('partials.notifications')
    		@show

            @yield('content')
        </div>
		<script src="{{ asset('js/jquery.min.js')}}"></script>
		<script src="{{ asset('js/bootstrap.js')}}"></script>
	</body>
</html>