@extends('admin.layouts.default')

@section('title', 'Mis Ofertas')

@section('content')
	<div class="col-md-9">
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
            <th>Razón</th>
            <th>Artículo</th>
            <th>Monto</th>
            <th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($offers as $o)
						<tr>
              <td>{{$o->getReason()}}</td>
              <td>{{$o->article->title}}</td>
              <td>${{$o->amount}}</td>
              <td>
                <a href="{{route('articles.show', $o->article->id)}}" class="btn btn-default btn-default">Ver Artículo</a>
								@if($o->article->isActive())
									<a href="{{route('admin.articles.offers.edit', [$o->article->id, $o->id])}}" class="btn btn-default">Editar</a>
									<a href="{{route('admin.offer.alert', $o->id)}}" class="btn btn-danger">Borrar</a>
								@else
									<span>La subasta finalizó</span>
								@endif
              </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@overwrite
