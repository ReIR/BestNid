@extends('admin.layouts.default')

@section('title', 'Preguntas a mis subastas')

@section('content')
	<div class="col-md-9">
    <div class="row">
			<div class="col-md-6">
				{{--<form class="form-inline" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Buscar por ">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>--}}
				<form class="form-inline" role="search">
					<div class="form-group">
						<select class="form-control" name="answered">
							<option value="0" {{Request::get('answered') == 0 ? 'selected' : ''}}>Sin Responder</option>
							<option value="1" {{Request::get('answered') == 1 ? 'selected' : ''}}>Repondidas</option>
							<option value="" {{ (!Request::has('answered')) ? 'selected' : ''}}>Todas</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default">Filtrar</button>
				</form>
			</div>
    </div>

		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
            <th>Artículo</th>
            <th>Pregunta</th>
            <th>Respondida</th>
            <th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($questions as $q)
						<tr class="{{$q->answer ? 'text-muted' : ''}}">
              <td>{{$q->article->title}}</td>
              <td>{{$q->text}}</td>
              <td>{{$q->answer ? 'Si' : 'No'}}</td>
              <td>
                <a href="{{route('articles.show', $q->article_id)}}" class="btn btn-default">Ver</a>
              </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@overwrite
