@extends('admin.layouts.default')

@section('title', 'Alta categoría')

@section('content')
	<div class="col-md-9">
		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center">Nueva categoría</h1>
			{!! Form::open(array('route' => 'admin.categories.store' ,'method' => 'POST')) !!}
			<div class="form-group">
				{!! Form::text('name', '', array('placeholder' => 'Nombre', 'class' => 'form-control')) !!}
			</div>
			<div class="form-group pull-right">
				{!! Form::submit('Enviar', array('class' => 'btn btn-default')) !!}
				<a class="btn btn-danger" href="{{route('admin.categories.index')}}">Cancel</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@overwrite
