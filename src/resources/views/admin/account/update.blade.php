@extends('layouts.default')

@section('title', 'Editar Cuenta')

@section('notifications')@overwrite

@section('content')
	<div class="col-md-6 col-md-offset-3 form-container">
		<div class="panel panel-default">
		  <div class="panel-heading">Editar Cuenta</div>
		  <div class="panel-body">
				@if(Session::has('success') || Session::has('error'))
					<div class="row">
						@include('partials.notifications')
					</div>
				@endif
		    {!! Form::open(array('route' => array('admin.account.update'), 'method' => 'PATCH')) !!}

					<?php $error = Session::has('errors') && Session::get('errors')->get('firstName'); ?>
		    	<div class="form-group {{$error ? 'has-error' : ''}}">
		    	    <label for="firstName">Nombre</label>
		    		<input
		    			class="form-control"
		    			type="text"
		    			name="firstName"
		    			id="firstName"
		    			value="{{$user->firstName}}" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('firstName')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('lastName'); ?>
		    	<div class="form-group {{$error ? 'has-error' : ''}}">
		    		<label for="lastName">Apellido</label>
		    		<input
		    			class="form-control"
		    			type="text"
		    			name="lastName"
		    			id="lastName"
		    			value="{{$user->lastName}}" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('lastName')[0]}}
								</span>
							@endif
		    	</div>

		    	<?php $error = Session::has('errors') && Session::get('errors')->get('username'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    	    <label for="username">Nombre de usuario</label>
		    		<input
		    			class="form-control"
		    			type="text"
		    			name="username"
		    			id="username"
		    			value="{{$user->username}}" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('username')[0]}}
								</span>
							@endif
		    	</div>

					<?php $error = Session::has('errors') && Session::get('errors')->get('email'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
					<label for="email">Email</label>
		    		<input
		    			class="form-control"
		    			type="email"
		    			name="email"
		    			id="email"
						@if($error)
			    			value="<?php echo Session::get('data')['email']; ?>" />
							<span class="text-danger">
								{{Session::get('errors')->get('email')[0]}}
							</span>
						@else
							value="{{$user->email}}" />
						@endif
		    	</div>

		    	{!! Form::submit('Aceptar', array('class' => 'btn btn-success')) !!}
		    	<a class="btn btn-danger" href="{{route('admin.index')}}">Cancelar</a>
		    	{!! Form::close() !!}
		  </div>
			@if ( !App\User::currentUserIsAdmin() )
				<div class="panel-footer">
					{!! Form::open(array('url'=> route('admin.account.delete'), 'method' => 'delete')) !!}
						<input type="submit" class="btn btn-link" value="Desactivar mi cuenta" />
					{!! Form::close() !!}
				</div>
			@endif
		</div>
	</div>
@overwrite
