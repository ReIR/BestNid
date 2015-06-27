@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
	<div class="col-md-9">
		<div class="row">
			<div>
			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active">
						<a href="#closedQuestions" aria-controls="Preguntas respondidas" role="tab" data-toggle="tab">
							Preguntas que te han Respondido
							<span class="badge">{{App\Question::countMyAnsweredQuestions()}}</span>
						</a>
					</li>
			    <li role="presentation">
						<a href="#activeQuestions" aria-controls="Preguntas sin respuesta" role="tab" data-toggle="tab">
							Preguntas sin respuesta
							<span class="badge">{{App\Question::countMyPendingQuestions()}}</span>
						</a>
					</li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="closedQuestions">
			      <table class="table table-hover">
							<thead>
								<tr>
									<th colspan="1">Preguntas</th>
									<th colspan="1">Respuestas</th>
			            <th colspan="1">Artículo</th>
									<th colspan="2">Acciones</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($answeredQuestions as $aq)

									<tr>
										<td>{{$aq->text}}</td>
										<td>{{$aq->answer_text}}</td>
			              <td>{{$aq->article->title}}</td>

										<td
											<div class="text-right">
												<a class="btn btn-success" href="{{ route('articles.offers.create', ['id'=> $aq->article->id])}}" role="button">Ofertar</a>
											</div>
										</td>

										<td
											<div class="text-right">
												<a class="btn btn-default" href="{{route('articles.show', ['id' => $aq->article->id])}}" role="button">Ver artículo</a>
											</div>
										</td>
									</tr>

			          @empty
			          <tr>
			            <td>No han respondido a ninguna de tus preguntas.</td>
			          </tr>
								@endforelse
							</tbody>
						</table>
					</div>
			    <div role="tabpanel" class="tab-pane" id="activeQuestions">
						<table class="table table-hover">
							<thead>
								<tr>
									<th colspan="1">Preguntas</th>
			            <th colspan="1">Artículo</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($questions as $q)
									<tr>
										<td>{{$q->text}}</td>
			              <td>{{$q->article->title}}</td>
									</tr>
			          @empty
			          <tr>
			            <td>No tienes ninguna pregunta activa.</td>
			          </tr>
								@endforelse
							</tbody>
						</table>
					</div>
			  </div>
			</div>
		</div>
	</div>
@overwrite
