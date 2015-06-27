<?php $route = Route::currentRouteName(); ?>

<ul class="list-group">
	<li class="list-group-item {{($route == 'admin.articles.index') ? 'active' : ''}}">
		<span class="badge">{{App\User::currentTotalArticles()}}</span>
		<a href="{{route('admin.articles.index')}}">Subastas</a>
	</li>
	<li class="list-group-item {{($route == 'admin.sales.index') ? 'active' : ''}}">
		<span class="badge">{{App\Sale::countMySales()}}</span>
		<a href="{{route('admin.sales.index')}}">Ventas</a>
	</li>
	<li class="list-group-item {{($route == 'admin.questions.index') ? 'active' : ''}}">
		<span class="badge">{{App\Question::countMyPendingQuestions()}}</span>
		<span class="badge">{{App\Question::countMyAnsweredQuestions()}}</span>
		<a href="{{route('admin.questions.index')}}">Mis preguntas</a>
	</li>
	<li class="list-group-item">
		<span class="badge">{{App\Question::countMyArticlesQuestions()}}</span>
		<a href="{{route('admin.account.questions')}}">Preguntas de mis subastas</a>
	</li>
	<li class="list-group-item {{($route == 'admin.account.offers') ? 'active' : ''}}">
		<span class="badge">{{Auth::user()->offers->count()}}</span>
		<a href="{{route('admin.account.offers')}}">Mis Ofertas</a>
	</li>
	@if ( App\User::currentUserIsAdmin() )
		<li class="list-group-item">
			<span class="badge">{{App\User::count()}}</span>
			<a href="#">Usuarios</a>
		</li>
		<li class="list-group-item">
			<span class="badge">{{App\Category::count()}}</span>
			<a href="{{route('admin.categories.index')}}">Categorías</a>
		</li>
	@endif
</ul>
