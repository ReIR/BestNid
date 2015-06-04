<html>
<head>
    <title>Warning</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
</head>
<body>
    <div class="container-fluid">
        {!! Form::open(array('route' => ['admin.categories.destroy', $category->id], 'method' => 'DELETE')) !!}
            {!! Form::submit('Borrar', array('class' => 'btn btn-danger')) !!}
        {!! Form::close() !!}
        <a role="button" class="btn btn-default" href="{{route ('admin.categories.index')}}" >Cancelar</a>
    </div>
</body>
</html>
