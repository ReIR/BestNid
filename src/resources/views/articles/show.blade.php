@extends('layouts.default')

@section('title', 'Artículos')

@section('content')
	{{-- Article row --}}
	<div class="row">
		{{-- Image column --}}
		<div class="col-md-6">
			<a href="#" class='article-image' style='background-image: url({{ asset('images/'.$article->image) }})'></a>
		</div>	{{-- End of Image column --}}

		<div class="col-md-6">
		{{-- Article Information column--}}
			<h1>
				{{$article->title}}
				<a href="{{ route('articles.index')}}?cat={{$article->category->name}}" class="badge">{{$article->category->name}}</a>
			</h1>

			<h3><small>La subasta termina en</small></h3>

			<h4>{{$article->endDate}}</h4>

			<p>{{$article->description}}</p>

			{{-- Related Articles --}}
			@if($related)
				<h3>Más de la categoría {{$article->category->name}}</h3>
				@foreach ($related as $relatedArticle)
					<div class="col-xs-6 col-md-3">
						<a href="{{ route('articles.show')}}?id={{$relatedArticle->id}}" class="thumbnail">
							<img src="{{ asset('images/'.$relatedArticle->image) }}">
						</a>
					</div>
				@endforeach
			@endif
		</div> {{-- End of Info Column --}}
	</div>	{{-- End of Article row --}}

	{{-- Q&A row  --}}
	<div class="row">
		<h3>Preguntas al subastador</h3>

		{{-- Questions --}}
		<div class="media">
			<div class="media-left">
				<a href="#" class='avatar-image' style='background-image: url({{ asset('images/no_image_large.png') }})'></a>
			</div>
			<div class="media-body">
				<h4 class="media-heading">Tiene aire acondicionado?</h4>
					Sabes que todos los que vengo viendo no tienen aire... que onda el tuyo?
			</div>
		</div>		{{-- End of Question --}}
	</div>	{{-- End of Q&A row --}}
@stop
