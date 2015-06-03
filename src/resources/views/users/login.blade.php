@extends('layouts.default')

@section('title', 'Login')

@section('content')
	<div class="col-md-4 col-md-offset-4 form-container">
		<div class="panel panel-default">
		<div class="panel-heading">Iniciar Sesión</div>
			<div class="panel-body">
				{!! Form::open(array('route' => 'users.postLogin', 'method' => 'POST')) !!}
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							{!! Form::text('username', '', array('placeholder' => 'Usuario', 'class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							{!! Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'form-control')) !!}
						</div>
					</div>
					{!! Form::submit('Entrar', array('class' => 'btn btn-success')) !!}
					<a href="{{route('users.create')}}">¿No estás registrado?</a>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@overwrite