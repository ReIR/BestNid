@extends('layouts.default')

@section('title', 'Administración')

<div class="col-md-3">
	@section('sidebar')
		@include('admin.partials.menu')
	@show
</div>
<!-- Aquí debería tener el col-md-9, pero las cosas no salen como queremos. -->
	@section('content')
