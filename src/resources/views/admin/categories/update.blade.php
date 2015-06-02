@extends('layouts.default')

@section('title', 'Actualización categoría')

@section('content')
	<h1>Actualización categoría</h1>
	{!! Form::open(array('route' => 'categories.update', 'method' => 'POST')) !!}
		{!! Form::text('name', '', array('placeholder' => 'Nombre')) !!}
		{!! Form::submit('Enviar', array('class' => 'button')) !!}
	{!! Form::close() !!}
@overwrite