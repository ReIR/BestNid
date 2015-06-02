@extends('layouts.default')

@section('title', 'Categoría')

@section('content')

		@if($category)
			<h1>Categoría: {{ $category->name }}</h1>
			<p>This category is {{ $category->id }} {{ $category->name }}</p>
			<ul>
				<li><a href="{{ route('categories.index') }}">Atrás</a></li>
				<li>
					{!! Form::open(array('route' => ['categories.destroy', $category->id], 'method' => 'DELETE')) !!}
						{!! Form::submit('Borrar', array('class' => 'button')) !!}
					{!! Form::close() !!}
				</li>
			</ul>
		@endif
@stop