<html>
	<head>
		 <title>Bestnid - @yield('title')</title>
		 <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
		 <link rel="stylesheet" href="{{asset('css/bestnid.css')}}">
			@section('scripts')
				<script src="{{ asset('js/jquery.min.js')}}"></script>
				<script src="{{ asset('js/bootstrap.js')}}"></script>
				<script src="{{ asset('js/bestnid.js')}}"></script>
			@show
	</head>
	<body>

		<?php $route = Route::currentRouteName(); ?>

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
		        <a class="navbar-brand background-logo" href="{{route('home')}}"></a>
		      </div>

		      <!-- Collect the nav links, forms, and other content for toggling -->
		      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li>
									<a href="{{route('articles.index')}}"
									class="{{($route == 'articles.index') ? 'active' : ''}}">Inicio</a>
								</li>
								@if(Auth::check())
									<li>
										<a href="{{route('admin.index')}}"
										class="{{($route == 'admin.index') ? 'active' : ''}}">Administración</a>
									</li>
								@endif
							</ul>

		        {!! Form::open(array('route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-search-input col-sm-6')) !!}
		       		<input type="hidden" name="cat" value="{{Request::get('cat')}}"/>
		        	<div class="input-group">
		        		{!! Form::text('q', Request::input('q'), array('placeholder' => 'Buscar...', 'class' => 'form-control')) !!}
        		      <span class="input-group-btn">
        		        <button class="btn btn-default button-icon" type="submit">
        		        	<span class="glyphicon glyphicon-search"></span>
        		        </button>
        		      </span>
		        	</div>
		        {!! Form::close() !!}


		        <ul class="nav navbar-nav navbar-right">
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
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->getFullName()}} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li>
		          		<a href="{{route('admin.account.edit')}}"
		          			class="{{($route == 'admin.account.edit') ? 'active' : ''}}">
		          				Editar Cuenta
		          		</a>
								</li>
								<li>
									<a href="{{route('admin.account.changePass')}}">Cambiar Contraseña</a>
								</li>
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

		@section('footer')
			<footer class="footer"></footer>
		@show
	</body>
</html>
