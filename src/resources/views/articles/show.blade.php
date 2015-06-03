@extends('layouts.default')

@section('title', 'Artículos')

@section('content')
	{{-- Article row --}}
	<div class="row">
		<div class="col-lg-12">
			{{-- Image column --}}
			<div class="col-sm-4 col-xs-offset-2">
				{{-- <div class="col-md-4 col-lg-offset-2"> --}}
					<img src="{{$article->getImageURL()}}" class="img-responsive">
				{{-- </div> --}}
			</div>	{{-- End of Image column --}}

			<div class="col-sm-4">
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
					<div class="row">
						@foreach ($related as $relatedArticle)
							<div class="col-sm-4">
								<div class="thumbnail">
									<a href="{{route('articles.show', ['id' => $relatedArticle->id])}}">
										<img src="{{$relatedArticle->getImageURL()}}">
									</a>
								</div>
							</div>
						@endforeach
						<div class="col-sm-4">
							<div class="thumbnail">
								<a href="{{ route('articles.index')}}?cat={{$article->category->name}}">
									<img src="{{ asset('images/more.png') }}">
								</a>
							</div>
						</div>
					</div>
				@endif
			</div> {{-- End of Info Column --}}
		</div>	{{-- End of Article row --}}
	</div>

	{{-- Q&A row  --}}
	<div class="row">
		<div class="col-lg-12">
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
	</div>
@stop
