<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use Session;
use Validator;
use App\Article;
use App\Category;

class ArticlesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

		//Set eager query (performance enhancement)
		$articles = Article::with('category');

		//Query for all the category (should me moved to another method)
		if ( Request::has('cat')) {
			$articles = $articles->ofNamedCategory(Request::get('cat'));
		}

		//Query for the name in the results from before.
		if ( Request::has('q')) {
			$articles = $articles->named(Request::get('q'));
		}

		//Here is when the query is actualy run.
		$articles = $articles->get();


		//Check for results.
		if (!count($articles))
		{
			return redirect()
				->route('articles.index')
				->with('error', 'No se han encontrado artículos que cumplan las condiciones de búsqueda.');
		}

		$categories = Category::all();

		return view('articles.index')
				->with('articles', $articles)
				->with('categories', $categories);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Find the requested article.
		$article = Article::find($id);

		//Fail if not found.
		if (!$article) {
			abort(404, 'No se encontró el artículo: '.$id);
		}

		//Get 3 articles of the same category.
		$related = Article::with('category')->ofCategory($article->category_id)->orderBy(\DB::raw('RAND()'))->take(2)->get();

		//Case of not finding related articles return a view without them.
		if(!count($related)) {
			return view('articles.show')
						->with('article', $article)
						->with('related', null);
		}

		//Return the view of the article and its relateds.
		return view('articles.show')
					->with('article', $article)
					->with('related', $related);
	}
}
