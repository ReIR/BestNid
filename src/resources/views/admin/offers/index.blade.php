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
								{{--
								{!! Form::open(array('route' =>
									['admin.articles.offers.sales.store', [$o->article_id, $o->id]], 'method' => 'POST')) !!}
									{!! Form::hidden('article_id', $o->article_id)!!}
									{!! Form::hidden('offer_id', $o->id)!!}
									{!! Form::hidden('user_id', $o->user_id)!!}
									{!! Form::submit('Elegir', array('class' => 'btn btn-success')) !!}
								{!! Form::close() !!}
								--}}
								<form class="" action="{{route('admin.articles.offers.sales.store', [$o->article_id, $o->id] )}}" method="post">
									<input type="numeric" name="article_id" class="form-control hidden" value="{{$o->article_id}}">
									<input type="numeric" name="offer_id" class="form-control hidden" value="{{$o->id}}">
									<input type="numeric" name="user_id" class="form-control hidden" value="{{$o->user_id}}">
									<button type="submit" class="btn btn-success">Elegir</button>
								</form>
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
