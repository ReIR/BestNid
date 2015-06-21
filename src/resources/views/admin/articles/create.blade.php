@extends('admin.layouts.default')

@section('title', 'Alta categoría')

@section('notifications')@stop

@section('content')
	<div class="col-md-9">
		<div class="col-md-12">
			{!! Form::open(array('route' => 'admin.articles.store' ,'method' => 'POST',  "enctype" => "multipart/form-data", "class" => 'article-form')) !!}
			<div class="form-group">
				<?php
					$error = Session::has('errors') && Session::get('errors')->get('title');
					$value = Request::old('title');
				?>
				<div class="input-group col-xs-12">
					<label for="title">Título</label>
					{!! Form::text('title', $value, array('placeholder' => 'Título de la subasta', 'class' => 'form-control')) !!}
					@if($error)
						<div class="text-danger">
							{{Session::get('errors')->get('title')[0]}}
						</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<?php
					$error = Session::has('errors') && Session::get('errors')->get('description');
					$value = Request::old('description');
				?>
				<div class="input-group col-xs-12">
					<label for="description">Descripción</label>
					{!! Form::textarea('description', $value, array('placeholder' => 'Descripción...', 'class' => 'form-control')) !!}
					@if($error)
						<div class="text-danger">
							{{Session::get('errors')->get('description')[0]}}
						</div>
					@endif
				</div>
			</div>
			<div class="form-group form-inline">
				<?php
					$error = Session::has('errors') && Session::get('errors')->get('category_id');
					$value = Request::old('category_id');
				?>
				<div class="input-group col-xs-12 col-md-4">
					<label for="category_id">Categoría</label>
					{!! Form::select('category_id', $categories, $value, array('placeholder' => 'Categoría', 'class' => 'form-control')) !!}
					@if($error)
						<div class="text-danger">
							{{Session::get('errors')->get('category_id')[0]}}
						</div>
					@endif
				</div>
				<?php
					$error = Session::has('errors') && Session::get('errors')->get('endDate');
					$value = Request::old('endDate');
				?>
				<div class="input-group col-xs-12 col-md-4">
					<label for="endDate">Fecha de finalización</label>
					<input type="date" name="endDate" class="form-control" value="{{$value}}" />
					@if($error)
						<div class="text-danger">
							{{Session::get('errors')->get('endDate')[0]}}
						</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<?php
					$error = Session::has('errors') && Session::get('errors')->get('image');
				?>
				<div class="input-group">
					<label for="endDate">Imagen</label>
					<div class="preview">
						<img id="uploadPreview" class="img-responsive" style="width: 100px; height: 100px; display: none;" />
					</div>
					<div class="uploadField" data-content="Agregar">
						<input id="uploadImage" type="file" name="image"/>
					</div>
					@if($error)
						<div class="text-danger">
							{{Session::get('errors')->get('image')[0]}}
						</div>
					@endif
				</div>
			</div>
			<div class="form-group pull-right">
				{!! Form::submit('Enviar', array('class' => 'btn btn-default')) !!}
				<a class="btn btn-danger" href="{{route('admin.categories.index')}}">Cancelar</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@overwrite
