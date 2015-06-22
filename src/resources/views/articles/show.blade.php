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
				<div class="row">
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

					<span class="subasta-info">La subasta termina el: <span id='endDate'></span> (<span id='endTime'class="text-danger"></span>)
					</span>
				</div>
				<div class="row">
						@if (Auth::check() && Auth::user()->id != $article->user_id )
							<a class="btn btn-success" href="{{ route('offers.create', ['id'=> $article->id])}}" role="button">Ofertar</a>
						@endif
				</div>
				<div class="row">
					<div class="subasta-description col-md-9">
							<p>{{$article->getDescription(700)}}</p>
					</div>
				</div>
			</div> {{-- End of Info Column --}}

			{{-- Q&A row  --}}
			<div class="row" style="padding-top: 40px;">
				<div class="col-lg-12">
					<h4 class="btn btn-danger" id="questions-button">
						Preguntas al subastador <span class="badge">{{count($questions)}}</span>
					</h4>
				</div>
			</div>

			<div id="questions" class="row hidden" style="padding-top: 40px;">
				<div class="col-lg-10">
					{{-- Questions --}}
					@foreach($questions as $question)
						<div class="media">	{{-- Question Start --}}
							<div class="media-body">
								<h4 class="media-heading">{{$question->text}}</h4>
							</div>
						</div>	{{-- End of Question --}}
					@endforeach
					<div class="col-md-12"> {{-- Question Form --}}
						<div class="panel panel-default">
							<div class="panel-heading">Agregar Pregunta</div>
								<div class="panel-body">
									<div class="row">
										@include('partials.notifications')
									</div>
									{!! Form::open(array('route' => ['articles.questions.store', $article->id], 'method' => 'POST', 'class' => 'form-inline')) !!}
									<textarea class='col-md-11' rows='3' name='text' placeholder='Qué desea preguntar?'></textarea>
									{!! Form::hidden('article_id', $article->id)!!}
									{!! Form::submit('Enviar', array('class' => 'btn btn-danger')) !!}
								</div>
							</div>
					</div>
				</div>	{{-- End of Question Form --}}
			</div>	{{-- End of Q&A section --}}

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
