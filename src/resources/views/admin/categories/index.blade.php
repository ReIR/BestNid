@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')

<div class="col-md-9">
	<div class="row pull-right">
		<a class="btn btn-default" href="{{route('admin.categories.create')}}" role="button">Crear categoría</a>
	</div>
	<div class="row">
		<table class="table table-hover">
			<thead>
				<tr>
					<th colspan="2">Nombre categoría</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $c)
					<tr>
						<td>{{$c->name}}</td>
						<td
							<div class="text-right">
								<a class="btn btn-default" href="{{route('admin.categories.edit', ['id' => $c->id])}}" role="button">Editar</a>
								<a class="btn btn-danger" href="{{route ('admin.categories.alert', ['id'=>$c->id])}}" role="button">Borrar</a>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop
