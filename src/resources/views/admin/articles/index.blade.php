@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
	<div class="col-md-9">
		<!-- Row Form Search Article By Title -->
		<div class="row">
			<div class="col-md-6">
				<form class="form-inline" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Buscar por ">
					</div>
					<button type="submit" class="btn btn-default">Buscar</button>
				</form>
			</div>

			<!-- Single button -->
			<a class="btn btn-success pull-right" href="{{route('admin.articles.create')}}">
				Agregar
			</a>

		</div>

		<!-- Row View Categories Table -->
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover ">
	 				 <thead>
	 					<tr>
	 						<th>Autor</th>
	 						<th>Título</th>
	 						<th>Categoría</th>
	 						<th></th>
	 					</tr>
	 				 </thead>
	 				 <tbody>
	 				 	<tr>
	 				 		<td>Nombre</td>
	 				 		<td>Un título</td>
	 				 		<td>Una categoría</td>
	 				 		<td>
	 				 			<div class="pull-right">
		 				 			<a class="btn btn-default" href="#" role="button">Editar</a>
		 				 			<a class="btn btn-default" href="#" role="button">Borrar</a>
	 				 			</div>
							</td>
	 				 	</tr>
	 				 </tbody>
	 			</table>
 			</div>
		</div>
	</div>
@stop
