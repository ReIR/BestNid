@extends('layouts.default')

@section('title', 'Artículos')

@section('content')
		<div class="col-lg-10 col-lg-offset-2 article">
			{{-- Image column --}}
			<div class="col-sm-5 img-container" style="background-image:url({{$article->getImageURL()}});"></div>
			{{-- End of Image column --}}

			<div class="col-sm-6">
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
					<div class="subasta-description col-md-9">
							<p>{{$article->getDescription(700)}}</p>
					</div>
				</div>
			</div> {{-- End of Info Column --}}

			{{-- Q&A row  --}}
			<div class="row">
				<div class="col-sm-12 article-buttons">
					@if ($isLoggedIn && !$isOwner)
						<a class="btn btn-success" href="{{ route('offers.create', ['id'=> $article->id])}}" role="button">Ofertar</a>
					@endif
					@if(!$isLoggedIn)
						<span class="text-muted">
							Para poder ofertar debe <a class="text-danger" href="{{route('users.getLogin')}}">iniciar sesión.</a>
						</span>
					@endif
					<button class="btn btn-danger" id="questions-button">
						Preguntas <span class="badge">{{count($questions)}}</span>
					</button>
				</div>
			</div>

			<div id="questions" class="row hidden" style="padding-top: 40px;">
				<div class="col-md-10">
					{{-- Questions --}}
					@foreach($questions as $question)
					<div class="row">
						<div class="col-md-12">

							<div class="media">	{{-- Question Start --}}
								<div class="media-body">
									<h4 class="media-heading">{{$question->text}}</h4>
								</div>
							</div>	{{-- End of Question --}}

							@if($question->isAnswered())

							<div class="col-md-10"> {{-- Answer  --}}
								<div class="panel panel-default">
									<div class="panel-body">
										<h4 class="media-heading">{{$question->answer()->first()->text}}</h4>
									</div>
								</div>
							</div> {{-- End of Answer  --}}

							@endif

							@if($isOwner && !$question->isAnswered())
								<div class="col-md-10"> {{-- Answer Form --}}
									<div class="panel panel-default">
										<div class="panel-heading">Responder Pregunta</div>
										<div class="panel-body">
											{!! Form::open(array('route' => ['articles.questions.answers.store', $article->id, $question->id], 'method' => 'POST', 'class' => 'form-inline')) !!}
												{!! Form::textarea('text', null, ['rows' => '3', 'class' => 'col-md-11', 'placeholder' => 'Escribe tu respuesta aquí.']) !!}
												{!! Form::submit('Enviar', array('class' => 'btn btn-danger')) !!}
											{!! Form::close() !!}
										</div>
									</div>
								</div> {{-- End of Answer Form --}}
							@endif

						</div>
					</div>
					@endforeach

					@if($isLoggedIn && !$isOwner)

						<div class="col-md-10"> {{-- Question Form --}}
							<div class="panel panel-default">
								<div class="panel-heading">Agregar Pregunta</div>
									<div class="panel-body">
										{!! Form::open(array('route' => ['articles.questions.store', $article->id], 'method' => 'POST', 'class' => 'form-inline')) !!}
										<textarea class='col-md-11' rows='3' name='text' placeholder='Qué desea preguntar?'></textarea>
										{!! Form::hidden('article_id', $article->id)!!}
										{!! Form::submit('Enviar', array('class' => 'btn btn-danger')) !!}
									</div>
								</div>
						</div> {{-- End of Question Form --}}

					@endif

					@if(!$isLoggedIn)

						<div class="row">
							<div class="col-md-12">
								<span class="text-muted">
									Para poder hacer consultas debe <a class="text-danger" href="{{route('users.getLogin')}}">iniciar sesión.</a>
								</span>
							</div>
						</div>

					@endif

				</div>
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
