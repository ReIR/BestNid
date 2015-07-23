@extends('admin.layouts.default')

@section('title','Alerta')

@section('content')
<div class="col-md-9 col-lg-9">
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <h4 id="oh-snap!-you-got-an-error!">¡Aviso!<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
        <p>{{$message}}</p>
        <p>
            {!! Form::open(array('route' => ['admin.categories.destroy', $category->id], 'method' => 'DELETE')) !!}
                {!! Form::submit('Borrar', array('class' => 'btn btn-danger')) !!}
                <a role="button" class="btn btn-default" href="{{route ('admin.categories.index')}}" >Cancelar</a> 
            {!! Form::close() !!}
        </p>
    </div>
</div>


@stop
