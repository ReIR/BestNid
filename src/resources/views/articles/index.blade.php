@extends('layouts.default')

@section('title', 'Artículos')

<?php $cat = Request::get('cat'); ?>

@section('sidebar')
	<div class="col-md-3">
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
		<div class="row">
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
