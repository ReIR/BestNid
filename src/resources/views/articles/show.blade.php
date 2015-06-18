@extends('layouts.default')

@section('title', 'Artículos')

@section('content')
		<div class="col-lg-10 col-lg-offset-2 article">
			{{-- Image column --}}
			<div class="col-sm-4 img-container">
				{{-- <div class="col-md-4 col-lg-offset-2"> --}}
					<img src="{{$article->getImageURL()}}" class="img-responsive">
				{{-- </div> --}}
			</div>	{{-- End of Image column --}}

			<div class="col-sm-8">
			{{-- Article Information column--}}
				<h1>
					<span>
						{{$article->title}}
					</span>
					<a href="{{ route('articles.index')}}?cat={{$article->category->name}}">
						<span class="badge">
							{{$article->category->name}}
						</span>
					</a>
				</h1>

				<span class="subasta-info">La subasta termina el: <span id='endDate'></span>(<span id='endTime'class="text-danger"></span>)</span>
				<div class="subasta-description col-md-9">
					<p>{{$article->getDescription(700)}}</p>
				</div>
			</div> {{-- End of Info Column --}}

			{{-- Q&A row  --}}
			<div class="row" style="padding-top: 40px;">
				<div class="col-lg-12">
					<h4 class="btn btn-danger" id="questions-button">
						Preguntas al subastador <span class="badge">1</span>
					</h4>
				</div>
			</div>

			<div id="questions" class="row hidden" style="padding-top: 40px;">
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

			<div class="col-md-9 related">
				{{-- Related Articles --}}
				@if($related)
					<h4>Relacionados de {{$article->category->name}}</h4>
					{{-- Related articles Row --}}
					<div class="row">
						<div class="col-sm-12">
							@foreach ($related as $relatedArticle)
								{{-- A related Article --}}
								<div class="col-xs-3">
									<div class="thumbnail">
										<a href="{{route('articles.show', ['id' => $relatedArticle->id])}}">
											<img src="{{$relatedArticle->getImageURL()}}">
										</a>
									</div>
								</div>
							@endforeach
							{{-- Search by category link --}}
							<div class="col-xs-12">
								<div class="thumbnail text-center">
									<a href="{{ route('articles.index')}}?cat={{$article->category->name}}" class="">
										Mostrar más
									</a>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>	{{-- col-lg-12 --}}


	{{-- Countdown requirements --}}
	<div id='endDateIn' style='display:none;'>{{$article->endDate}}</div>
	@section('scripts')
		@parent
		<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
		<script src="{{asset('js/article.countdown.js')}}"></script>
	@stop
@stop
