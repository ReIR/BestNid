@extends('layouts.default')

@section('title', 'Artículos')

<?php
	$cat = Request::get('cat');
	$q = Request::get('q');
?>

@section('sidebar')
	<div class="col-md-3">
		<h4>Categorías</h4>
		<ul class="list-group">
			@foreach($categories as $c)
				<li class="list-group-item">
					<a href="{{route('articles.index')}}?cat={{$c->name}}">
						{{$c->name}}
					</a>
					@if ($c->name === $cat )
						<a href="{{route('articles.index')}}" class="pull-right text-danger">X</a>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
@show

@section('content')
	<div class="col-md-9">
		@if(Request::has('q'))
			<div class="row">
				<div class="col-md-12">
					{!! Form::open(array('route' => 'articles.index', 'method' => 'GET', 'class' => 'form-inline  pull-right')) !!}
						<input type="hidden" name="q" value="{{$q}}">
						<select class="form-control" name="cat">
							<option value="">
									Filtrar por Categoría
							</option>
							@foreach($categories as $c)
								<option value="{{$c->name}}" {{($c->name == $cat) ? 'selected="selected"' : ''}}>
										{{$c->name}}
								</option>
							@endforeach
						</select>
						{!! Form::submit('Buscar', array('class' => 'btn btn-default')) !!}
					{!! Form::close() !!}
				</div>
			@endif
			@foreach($articles as $a)
				<a href="{{route('articles.show', ['id' => $a->id])}}">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="{{$a->getImageURL()}}" alt="...">
							<div class="caption">
								<h3>{{$a->getTitle(20)}}</h3>
								<p>{{$a->getDescription(35)}}</p>
							</div>
						</div>
					</div>
				</a>
			@endforeach
		</div>
	</div>
@overwrite
