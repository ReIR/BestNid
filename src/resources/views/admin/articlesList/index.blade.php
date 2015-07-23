@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
	<div class="col-md-9">
		<!-- Row Form Search Article By Title -->
		<div class="row">
			<div class="col-md-12">
				{{--<form class="form-inline" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Buscar por ">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>--}}
				<form class="form-inline" role="search">
					<div class="form-group">
						<span>Filtrar entre</span>
		        <div class="input-group">
		          <input type="date" name="initialDate" class="form-control" value="{{Request::get('initialDate')}}" />
		        </div>
						<span>y</span>
		        <div class="input-group">
		          <input type="date" name="finalDate" class="form-control" value="{{Request::get('finalDate')}}" />
		        </div>
					</div>
					<div class="form-group pull-right">
						<span>Estado:</span>
						<select class="form-control" name="active">
							<option value="1" {{Request::get('active') == 1 ? 'selected' : ''}}>Activas</option>
							<option value="0" {{Request::get('active') == 0 ? 'selected' : ''}}>No Activas</option>
							<option value="" {{ (!Request::has('active')) ? 'selected' : ''}}>Todas</option>
						</select>
						<button type="submit" class="btn btn-default">Filtrar</button>
					</div>
				</form>
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
							<th>Fecha de Creación</th>
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
								<td>{{$article->getCreationDate()}}</td>
		 				 		<td>{{$remainingDays}} días</td>
		 				 		<td>
		 				 			<div class="pull-right">
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
