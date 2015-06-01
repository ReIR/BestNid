@extends('layouts.default')

@section('title', 'Login')

@section('content')
	<h1>Iniciar sesión</h1>

	{!! Form::open(array('route' => 'users.postLogin', 'method' => 'POST')) !!}
		<div class="form-group">
			{!! Form::text('username', '', array('placeholder' => 'Usuario', 'class' => 'form-control')) !!}
		</div>
		<div class="form-group">
			{!! Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'form-control')) !!}
		</div>
		{!! Form::submit('Entrar', array('class' => 'btn btn-default')) !!}
	{!! Form::close() !!}
@overwrite