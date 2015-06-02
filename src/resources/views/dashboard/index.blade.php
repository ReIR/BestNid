@extends('layouts.default')

@section('title', 'Administración')

@section('content')
	@if ( User::currentUserIsAdmin() )
		Hola, soy administrador!
	@else
		Hola, soy usuario!
	@endif
@overwrite