@extends('layouts.default')

@section('title', 'Cambiar Contraseña')

@section('notifications')@overwrite

@section('content')
	<div class="col-md-6 col-md-offset-3 form-container">
		<div class="panel panel-default">
		  <div class="panel-heading">Cambiar Contraseña</div>
		  <div class="panel-body">

		    {!! Form::open(array('route' => array('admin.account.updatePass'), 'method' => 'PATCH')) !!}

		    	<?php $error = Session::has('errors') && Session::get('errors')->get('password'); ?>
          <?php $error = (!$error && Session::has('error')) ? Session::get('error') : $error; ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    	    <label for="password">Contraseña Actual</label>
		    		<input
		    			class="form-control"
		    			type="password"
		    			name="password"
		    			id="password"
		    			value="" />
							@if($error)
								<span class="text-danger">
                  @if (Session::has('error'))
                    {{Session::get('error')}}
                  @elseif (Session::has('errors'))
									  {{Session::get('errors')->get('password')[0]}}
                  @endif
								</span>
							@endif
		    	</div>

          <?php $error = Session::has('errors') && Session::get('errors')->get('newpassword'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    	    <label for="newpassword">Nueva Contraseña</label>
		    		<input
		    			class="form-control"
		    			type="password"
		    			name="newpassword"
		    			id="newpassword"
		    			value="" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('newpassword')[0]}}
								</span>
							@endif
		    	</div>

          <?php $error = Session::has('errors') && Session::get('errors')->get('repassword'); ?>
					<div class="form-group {{$error ? 'has-error' : ''}}">
		    	    <label for="repassword">Reingrese la nueva contraseña</label>
		    		<input
		    			class="form-control"
		    			type="password"
		    			name="repassword"
		    			id="repassword"
		    			value="" />
							@if($error)
								<span class="text-danger">
									{{Session::get('errors')->get('repassword')[0]}}
								</span>
							@endif
		    	</div>

		    	{!! Form::submit('Aceptar', array('class' => 'btn btn-success')) !!}
		    	<a class="btn btn-danger" href="{{route('admin.index')}}">Cancelar</a>
		    {!! Form::close() !!}
		  </div>
		</div>
	</div>
@overwrite
