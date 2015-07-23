@extends('layouts.default')

@section('title', 'Registrarse')

@section('notifications')@overwrite

@section('content')
	<div class="col-md-6 col-md-offset-3 form-container">
		<div class="panel panel-default">
		  <div class="panel-heading">Registrarse</div>
		  <div class="panel-body">

		    {!! Form::open(array('route' => 'users.store', 'method' => 'POST')) !!}

					<?php $error = Session::has('errors') && Session::get('errors')->get('firstName'); ?>
		    	<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Nombre"
		    			class="form-control"
		    			type="text"
		    			name="firstName"
		    			value="<?php echo Session::get('data')['firstName']; ?>" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('firstName')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('lastName'); ?>
		    	<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Apellido"
		    			class="form-control"
		    			type="text"
		    			name="lastName"
		    			value="<?php echo Session::get('data')['lastName']; ?>" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('lastName')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('email'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Email"
		    			class="form-control"
		    			type="email"
		    			name="email"
		    			value="<?php echo Session::get('data')['email']; ?>" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('email')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('username'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Username"
		    			class="form-control"
		    			type="text"
		    			name="username"
		    			value="<?php echo Session::get('data')['username']; ?>" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('username')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('password'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Contraseña"
		    			class="form-control"
		    			type="password"
		    			name="password"
		    			value="" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('password')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('repassword'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<input placeholder="Repetir Contraseña"
		    			class="form-control"
		    			type="password"
		    			name="repassword"
		    			value="" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('repassword')[0]}}
								</span>
							@endif
		    	</div>
		    	{!! Form::submit('Registrarse', array('class' => 'btn btn-success')) !!}
		    	<a href="{{route('users.getLogin')}}">¿Ya estás registrado?</a>
		    {!! Form::close() !!}
		  </div>
		</div>
	</div>
@overwrite
