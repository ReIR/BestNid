@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
	<div class="col-md-9">
		<!-- Row Form Search Article By Title -->
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
						<select class="form-control" name="active">
							<option value="1" {{Request::get('active') == 1 ? 'selected' : ''}}>Activas</option>
							<option value="0" {{Request::get('active') == 0 ? 'selected' : ''}}>No Activas</option>
							<option value="" {{ (!Request::has('active')) ? 'selected' : ''}}>Todas</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default">Filtrar</button>
				</form>
			</div>

			<!-- Single button -->
			<a class="btn btn-default pull-right" href="{{route('admin.articles.create')}}">
				Agregar
			</a>
		</div>

		<!-- Row View Categories Table -->
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover ">
	 				 <thead>
	 					<tr>
	 						<th>Título</th>
	 						<th>Categoría</th>
							<th>Activa</th>
	 						<th>Días Restantes</th>
	 						<th><div class="pull-right">Acciones</div></th>
	 					</tr>
	 				 </thead>
	 				 <tbody>
						@foreach($articles as $article)
							<?php $remainingDays = $article->getRemainingDays(); ?>
		 				 	<tr class="{{$remainingDays <= 0 ? 'text-muted': ''}}">
		 				 		<td>{{$article->getTitle()}}</td>
		 				 		<td>{{$article->category->name}}</td>
								<td>{{$article->isActive() ? 'Si' : 'No'}}</td>
		 				 		<td>{{$remainingDays}} días</td>
		 				 		<td>
		 				 			<div class="pull-right">
										@if($article->isEditable())
												<a class="btn btn-primary" href="{{route('admin.articles.edit', $article->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Editar artículo">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
												</a>
												<a class="btn btn-danger" href="{{route('admin.articles.alert', $article->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Eliminar artículo">
													<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
												</a>
										{{-- @else
												<a class="btn btn-danger disabled" href="{{route('admin.articles.edit', $article->id)}}" role="button">
													<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
												</a>
												<a class="btn btn-danger disabled" href="{{route('admin.articles.alert', $article->id)}}" role="button">
													<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
												</a> --}}
										@endif
										@if($article->toBeFinished())
											<a class="btn btn-success" href="{{route('admin.articles.offers.index', $article->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Finalizar subasta">
												<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
											</a>
										{{-- @else
											<a class="btn btn-danger disabled" href="{{route('admin.articles.offers.index', $article->id)}}" role="button">
												<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
											</a> --}}
										@endif
										<a class="btn btn-default" href="{{route('articles.show', $article->id)}}" role="button" data-toggle="tooltip" data-placement="top" title="Ver artículo">
											<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
										</a>
		 				 			</div>
								</td>
		 				 	</tr>
						@endforeach
	 				 </tbody>
	 			</table>
 			</div>
		</div>
	</div>
@stop
