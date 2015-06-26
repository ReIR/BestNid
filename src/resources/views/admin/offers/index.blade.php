@extends('layouts.default')

@section('title', 'Ofertas')

@section('content')

<div class="col-md-12">
	<div class="col-lg-10 col-lg-offset-2 article">
		{{-- Image column --}}
		<div class="col-sm-5 img-container" style="background-image:url({{$article->getImageURL()}});"></div>
		{{-- End of Image column --}}

		<div class="col-sm-6">
			{{-- Article Information column--}}
			<div class="row">
				<h1>
					<span>
						{{$article->title}}
					</span>
					<a href="{{ route('articles.index')}}?cat={{$article->category->name}}">
						<span class="badge">
							{{$article->category->name}}
						</span>
					</a>
				</h1>
			</div>
			<div class="row">
				<div class="subasta-description col-md-9">
					<p>{{$article->getDescription(700)}}</p>
				</div>
			</div>
		</div> {{-- End of Info Column --}}

		<div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Razón</th>
						<th>Monto</th>
						<th class="text-right">Seleccionar ganadora</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($offers as $o)
					<tr>
						<td>
							{{$o->text}}
						</td>
						<td>
							{{$o->amount}}
						</td>
						<td>
							<div class="text-right">
								<a class="btn btn-success" href="#" role="button">Elegir</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>

@overwrite
