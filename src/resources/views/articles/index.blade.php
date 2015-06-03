@extends('layouts.default')

@section('title', 'Artículos')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="pull-left">
				<h1>Artículos</h1>
			</div>
			<div class="pull-right">
				<a href="{{ route('articles.create') }}" class="btn btn-primary mibotoncito">
					Crear
				</a>
			</div>
		</div>

		<div class="row marginTop10">
			@foreach ($articles as $a)
				<div class="panel panel-default">
				  <div class="panel-heading">
				  	<a href="{{ route('articles.show', ['id' => $a->id ]) }}">
				  		{{$a->title}}
				  	</a>
				  </div>
				  <div class="panel-body">
				    {{$a->title}}
				  </div>
				</div>
			@endforeach
		</div>
	</div>
@stop
