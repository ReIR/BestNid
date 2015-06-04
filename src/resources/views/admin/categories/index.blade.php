@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')

<div class="col-md-9">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre categoría</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $c)
				<tr>
					<td>{{$c->name}}</td>
					<td
						<div class="pull-right">
							<a class="btn btn-default" href="#" role="button">Editar</a>
							<a class="btn btn-danger" href="{{route ('admin.categories.alert', ['id'=>$c->id])}}" role="button">Borrar</a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop
