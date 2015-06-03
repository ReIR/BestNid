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
			<div class="btn-group col-md-3">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					Fecha inicio <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
				</ul>
			</div>

			<!-- Single button -->
			<div class="btn-group col-md-3">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					Fecha hasta <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Action</a></li>
					<li><a href="#">Another action</a></li>
					<li><a href="#">Something else here</a></li>
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
				</ul>
			</div>

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
@overwrite