@extends('layouts.default')

@section('title', 'Administración')

@section('content')
	@if ( App\User::currentUserIsAdmin() )
		Hola, soy administrador!
	@else
		Hola, soy usuario!
	@endif
@overwrite