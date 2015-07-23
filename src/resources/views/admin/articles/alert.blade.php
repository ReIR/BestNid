@extends('admin.layouts.default')

@section('title','Alerta')

@section('content')
<div class="col-md-9 col-lg-9">
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <h4 id="oh-snap!-you-got-an-error!">¡Aviso!<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
        <p>¿Está seguro que desea eliminar eliminar el artículo {{$article->title}}?</p>
				<p>{{$article->description}}</p>
        <p>
            {!! Form::open(array('route' => ['admin.articles.destroy', $article->id], 'method' => 'DELETE')) !!}
                {!! Form::submit('Borrar', array('class' => 'btn btn-danger')) !!}
                <a role="button" class="btn btn-default" href="{{route ('admin.articles.index')}}" >Cancelar</a>
            {!! Form::close() !!}
        </p>
    </div>
</div>


@stop
