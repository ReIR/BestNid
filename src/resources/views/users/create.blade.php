@extends('layouts.default')

@section('title', 'Registrarse')

@section('content')
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3 form-container">
			<div class="panel panel-default">
			  <div class="panel-heading">Registrarse</div>
			  <div class="panel-body">
			    {!! Form::open(array('route' => 'users.store', 'method' => 'POST')) !!}
			    	<div class="form-group">
			    		<input placeholder="Nombre" 
			    			class="form-control" 
			    			type="text" 
			    			name="firstName" 
			    			value="<?php echo Session::get('data')['firstName']; ?>" />
			    	</div>
			    	<div class="form-group">
			    		<input placeholder="Apellido" 
			    			class="form-control" 
			    			type="text" 
			    			name="lastName" 
			    			value="<?php echo Session::get('data')['lastName']; ?>" />
			    	</div>
			    	<div class="form-group">
			    		<input placeholder="Email" 
			    			class="form-control" 
			    			type="email" 
			    			name="email" 
			    			value="<?php echo Session::get('data')['email']; ?>" />
			    	</div>
			    	<div class="form-group">
			    		<input placeholder="Username" 
			    			class="form-control" 
			    			type="text" 
			    			name="username" 
			    			value="<?php echo Session::get('data')['username']; ?>" />
			    	</div>
			    	<div class="form-group">
			    		<input placeholder="Contraseña" 
			    			class="form-control" 
			    			type="password" 
			    			name="password" 
			    			value="" />
			    	</div>
			    	<div class="form-group">
			    		<input placeholder="Repetir Contraseña" 
			    			class="form-control" 
			    			type="password" 
			    			name="repassword" 
			    			value="" />
			    	</div>
			    	{!! Form::submit('Registrarse', array('class' => 'btn btn-success')) !!}
			    	<a href="{{route('users.getLogin')}}">¿Ya estás registrado?</a>
			    {!! Form::close() !!}
			  </div>
			</div>
		</div>
	</div>
@overwrite