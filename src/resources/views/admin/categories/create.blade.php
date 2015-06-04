@extends('admin.layouts.default')

@section('title', 'Alta categoría')

@section('content')
	<h1>Alta categoría</h1>
	{!! Form::open(array('route' => 'admin.categories.store', 'method' => 'POST')) !!}
		{!! Form::text('name', '', array('placeholder' => 'Nombre')) !!}
		{!! Form::submit('Enviar', array('class' => 'button')) !!}
	{!! Form::close() !!}
@overwrite
