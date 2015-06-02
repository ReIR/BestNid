@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
<div class="col-md-9">
	<table class="table table-hover">
		<thead>
			<tr >
				<th>Nombre categoría</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($categories as $c)
				<tr>
					<td>{{$c->name}}</td>
					<td>
						<div class="pull-right">
							<a class="btn btn-default" href="#" role="button">Editar</a>
							{!! Form::open(array('route' => ['admin.categories.destroy', $c->id], 'method' => 'DELETE')) !!}
							{!! Form::submit('Borrar', array('class' => 'button')) !!}
							{!! Form::close() !!}
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>			
	</table>
</div>
@stop