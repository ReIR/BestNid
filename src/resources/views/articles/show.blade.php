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
					@if ($isLoggedIn && !$isOwner && !$isOfferted)
						<a class="btn btn-success" href="{{ route('articles.offers.create', ['id'=> $article->id])}}" role="button">Ofertar</a>
					@endif
					@if(!$isLoggedIn)
						<span class="text-muted">
							Para poder ofertar debe <a class="text-danger" href="{{route('users.getLogin')}}">iniciar sesión.</a>
						</span>
					@endif
					<h3 class="text">
						Preguntas
					</h3>
					<hr class="separator">
				</div>
			</div>

			<div id="questions" class="row" style="padding-top: 40px;">
				<div class="col-md-10">

					<div class="panel panel-default">
					  <div class="panel-body">
							{{-- Questions --}}
							@forelse($questions as $question)
								<div class="row">
									<div class="col-md-12">

										<div class="panel panel-default">
										  <div class="panel-heading">{{$question->text}}</div>
												@if($question->isAnswered())
											  	<div class="panel-body">
														{{$question->answer()->first()->text}}
											  	</div>
												@elseif($isOwner)
													<div class="panel-body">
														<div class="col-md-12"> {{-- Answer Form --}}
																{!! Form::open(array('route' => ['articles.questions.answers.store', $article->id, $question->id], 'method' => 'POST', 'class' => 'form-inline')) !!}
																	{!! Form::textarea('text', null, ['rows' => '1', 'class' => 'form-control', 'cols' => "90", 'placeholder' => 'Escribe tu respuesta aquí.']) !!}
																	{!! Form::submit('Enviar', array('class' => 'btn btn-success')) !!}
																{!! Form::close() !!}
														</div> {{-- End of Answer Form --}}
													</div>
												@endif
										</div>
									</div>
								</div>
							@empty
								<p>Aún no hay preguntas :( </p>
							@endforelse

					  </div>

							@if(!$isLoggedIn)
						  	<div class="panel-footer">
									<div class="row">
										<div class="col-md-12">
											<span class="text-muted">
												Para poder hacer consultas debe <a class="text-danger" href="{{route('users.getLogin')}}">iniciar sesión.</a>
											</span>
										</div>
									</div>
								</div>
							@elseif(!$isOwner)
								<div class="panel-footer">
									<div class="row"> {{-- Question Form --}}
										<div class="col-md-12">
												{!! Form::open(array('route' => ['articles.questions.store', $article->id], 'method' => 'POST', 'class' => 'form-inline')) !!}
													{!! Form::textarea('text', null, ['rows' => '1', 'class' => 'form-control', 'cols' => "100", 'placeholder' => 'Escribe tu pregunta aquí.']) !!}
													{!! Form::hidden('article_id', $article->id)!!}
													{!! Form::submit('Enviar', array('class' => 'btn btn-success')) !!}
												{!! Form::close() !!}
										</div>
									</div> {{-- End of Question Form --}}
								</div>
							@endif
					</div>
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
