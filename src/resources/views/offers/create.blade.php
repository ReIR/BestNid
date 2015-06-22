@extends('layouts.default')

@section('title', 'Ofertar')

@section('notifications')@overwrite

@section('content')
		<div class="col-md-12">
			<h3 class="text-center">Producto sobre el que realizará la oferta: {{$article->title}}.</h3>

			<div class="col-sm-4">
				<div class="image-container col-md-6 col-md-offset-3">		
					{{-- <div class="col-md-4 col-lg-offset-2"> --}}
					<img src="{{$article->getImageURL()}}" class="img-responsive">
					{{-- </div> --}}
				</div>	{{-- End of Image column --}}
			</div>
			<div class="col-sm-8 form-container" style="margin-top:0px">
				<div class="col-md-10">
					<div class="panel panel-default">
					<div class="panel-heading text-center">Oferta</div>
					  	<div class="panel-body">

		 				{!! Form::open(array('route' => array('offers.store', $article->id), 'method' => 'POST')) !!}

							<?php $error = Session::has('errors') && Session::get('errors')->get('text'); ?>
				    	<div class="form-group {{$error ? 'has-error' : ''}}">
				    		<textarea placeholder="Razón" class="form-control" type="text" name="text"></textarea>
								@if($error)
									<span class="text-danger">
										{{Session::get('errors')->get('text')[0]}}								
									</span>
								@endif
				    	</div>

							<?php $error = Session::has('errors') && Session::get('errors')->get('amount'); ?>
				    	<div class="form-group {{$error ? 'has-error' : ''}}">
				    		<input placeholder="Monto" class="form-control" type="float" name="amount" />
								@if($error)
									<span class="text-danger">
										{{Session::get('errors')->get('amount')[0]}}	
									</span>
								@endif
				    	</div>

							<?php $error = Session::has('errors') && Session::get('errors')->get('card'); ?>
				    	<div class="form-group {{$error ? 'has-error' : ''}}">
				    		<input placeholder="Número de tarjeta" class="form-control" type="numeric" name="card" />
								@if($error)
									<span class="text-danger">
										{{Session::get('errors')->get('card')[0]}}
									</span>
								@endif
				    	</div>

								<?php $error = Session::has('errors') && Session::get('errors')->get('contact'); ?>
				    	<div class="form-group {{$error ? 'has-error' : ''}}">
				    		<input placeholder="Teléfono de contacto" class="form-control" type="numeric" name="contact" />
								@if($error)
									<span class="text-danger">
										{{Session::get('errors')->get('contact')[0]}}
									</span>
								@endif
				    	</div>

				    	{!! Form::submit('Aceptar', array('class' => 'btn btn-success')) !!}
				    	<a class="btn btn-danger" href="{{route('articles.show', ['id'=>$article->id])}}">Cancelar</a>
				    {!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@overwrite
