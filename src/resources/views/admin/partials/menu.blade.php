<?php $route = Route::currentRouteName(); ?>

<ul class="list-group">
	<li class="list-group-item {{($route == 'admin.articles.index') ? 'active' : ''}}">
		<span class="badge">1</span>
		<a href="{{route('admin.articles.index')}}">Subastas</a>
	</li>
	<li class="list-group-item">
		<span class="badge">2</span>
		<a href="#">Ventas</a>
	</li>
	<li class="list-group-item">
		<span class="badge">0</span>
		<a href="#">Preguntas</a>
	</li>
	@if ( App\User::currentUserIsAdmin() )
		<li class="list-group-item">
			<span class="badge">3</span>
			<a href="#">Usuarios</a>
		</li>
		<li class="list-group-item">
			<span class="badge">{{App\Category::count()}}</span>
			<a href="{{route('admin.categories.index')}}">Categorías</a>
		</li>
	@endif
</ul>
