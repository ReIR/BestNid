@extends('layouts.default')

@section('title', 'Artículos')

<?php
	$cat = Request::get('cat');
	$q = Request::get('q');
?>

@section('content')
<div class="row">
		<div class="col-md-12">
			{!! Form::open(array('route' => 'articles.index', 'method' => 'GET', 'class' => 'form-inline')) !!}
				<input type="hidden" name="q" value="{{$q}}">
				<select class="form-control" name="cat">
					<option value="">
							Todas las categorías
					</option>
					@foreach($categories as $c)
						<option value="{{$c->name}}" {{($c->name == $cat) ? 'selected="selected"' : ''}}>
								{{$c->name}}
						</option>
					@endforeach
				</select>
				{!! Form::submit('Filtrar', array('class' => 'btn btn-default')) !!}
			{!! Form::close() !!}
		</div>
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
@overwrite
