<ul class="list-group">
	<li class="list-group-item">
		<span class="badge">1</span>
		<a href="{{route('admin.articles.index')}}">Artículos</a>
	</li>
	<li class="list-group-item">
		<span class="badge">2</span>
		<a href="#">Ventas</a>
	</li>
	<li class="list-group-item">
		<span class="badge">3</span>
		<a href="#">Usuarios</a>
	</li>
	@if ( App\User::currentUserIsAdmin() )
		<li class="list-group-item">
			<span class="badge">{{App\Category::count()}}</span>
			<a href="{{route('admin.categories.index')}}">Categorías</a>
		</li>
	@endif
</ul>
