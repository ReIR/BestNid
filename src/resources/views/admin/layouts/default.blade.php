@extends('layouts.default')

@section('title', 'Administración')

@section('notifications')
	<div class="col-md-6 fixed-top">
		@include('partials.notifications')
	</div>
@stop

@section('sidebar')
	<div class="col-md-3">
		@include('admin.partials.menu')
	</div>
@show
