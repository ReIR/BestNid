@extends('layouts.default')

@section('title', 'Alta artículo')

@section('content')
	<h1>Alta artículo</h1>
	{!! Form::open(array('route' => 'articles.store', 'method' => 'POST')) !!}
		{!! Form::text('name', '', array('placeholder' => 'Nombre')) !!}
		{!! Form::submit('Enviar', array('class' => 'button')) !!}
	{!! Form::close() !!}
@overwrite