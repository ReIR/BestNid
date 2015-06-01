<html>
	<head>
		<title>Artículo</title> 
	</head>
	<body>
		@if($article)
			<h1>Artículo: {{ $article->name }}</h1>
			<p>This article is {{ $article->id }} {{ $article->name }}</p>
			<ul>
				<li><a href="{{ route('articles.index') }}">Atrás</a></li>
				<li>
					{!! Form::open(array('route' => ['articles.destroy', $article->id], 'method' => 'DELETE')) !!}
						{!! Form::submit('Borrar', array('class' => 'button')) !!}
					{!! Form::close() !!}
				</li>
			</ul>
		@endif
	</body>
</html>