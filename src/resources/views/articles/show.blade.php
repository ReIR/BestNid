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

				<div id='endDate'class="col-xs-12 pull-right text-danger"></div>

				<div class="col-xs-12">
					<p>{{$article->description}}</p>
				</div>

				{{-- Related Articles --}}
				@if($related)
					<h3>Más de la categoría {{$article->category->name}}</h3>
					{{-- Related articles Row --}}
					<div class="row">
						<div class="col-sm-12">
							@foreach ($related as $relatedArticle)
								{{-- A related Article --}}
								<div class="col-xs-4 col-sm-4 col-md-4">
									<div class="thumbnail">
										<a href="{{route('articles.show', ['id' => $relatedArticle->id])}}">
											<img src="{{$relatedArticle->getImageURL()}}">
										</a>
									</div>
								</div>
							@endforeach
							{{-- Search by category link --}}
							<div class="col-xs-4 col-md-4">
								<div class="thumbnail">
									<a href="{{ route('articles.index')}}?cat={{$article->category->name}}">
										<img src="{{ asset('images/more.png') }}">
									</a>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div> {{-- End of Info Column --}}
		</div>	{{-- End of Article row --}}
	</div>

	{{-- Q&A row  --}}
	<div class="row" style="padding-top: 40px;">
		<div class="col-lg-12">
			<h4 class="btn btn-danger">
				Preguntas al subastador <span class="badge">1</span>
			</h4>
		</div>
	</div>
	<div class="row" style="padding-top: 40px;">
		<div class="col-lg-12">
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

	{{-- Countdown requirements --}}
	<div id='endDateIn' style='display:none;'>{{$article->endDate}}</div>
	<script src="{{asset('js/jquery.min.js')}}" charset="utf-8"></script>
	<script src="{{asset('js/jquery.countdown.min.js')}}" charset="utf-8"></script>
	<script src="{{asset('js/article.countdown.js')}}" charset="utf-8"></script>
@stop
