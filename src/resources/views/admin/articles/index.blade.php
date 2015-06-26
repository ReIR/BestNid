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
	 						<th>Acciones</th>
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
			 				 			{{--<a class="btn btn-default" href="#" role="button">Editar</a>
			 				 			<a class="btn btn-default" href="#" role="button">Borrar</a>--}}
										<a class="btn btn-default" href="{{route('articles.show', $article->id)}}" role="button">Ver</a>
										@if($article->toBeFinished())
											<a class="btn btn-success" href="{{route('admin.articles.offers.index', $article->id)}}" role="button">Finalizar</a>
										@endif
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
