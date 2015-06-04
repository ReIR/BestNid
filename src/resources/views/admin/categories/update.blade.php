@extends('admin.layouts.default')

@section('title', 'Actualización categoría')

@section('content')

	<div class="col-md-9">
		<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center">Actualización de categoría</h1>
			{!! Form::open(array('route' => 'admin.categories.update' ,'method' => 'PATCH')) !!}
			<div class="form-group">
				{!! Form::text('name', $category->name, array('class' => 'form-control')) !!}
				{!! Form::hidden('id', $category->id)!!}
			</div>
			<div class="form-group pull-right">
				{!! Form::submit('Enviar', array('class' => 'btn btn-default')) !!}
				<a class="btn btn-danger" href="{{route('admin.categories.index')}}">Cancelar</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@overwrite
