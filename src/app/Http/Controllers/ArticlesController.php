<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Auth;
use Session;
use Validator;
use App\Article;
use App\Category;
use App\Question;
use App\Offer;

class ArticlesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

		//Set eager query (performance enhancement)
		$articles = Article::with('category')
								->notFinished();

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
		if ((Request::has('q') || Request::has('cat')) && !count($articles))
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

		//Get 4 articles of the same category.
		$related = Article::with('category')
								->ofCategory($article->category_id)
								->notFinished()
								->where('id', '!=', $id)
								->orderBy(\DB::raw('RAND()'))
								->take(4)
								->get();

		// $questions = Question::with('article')
		// 						->ofArticle($article->id)
		// 						->orderBy('created_at')
		// 						->get();

		$questions = $article->questions()
								->orderBy('created_at')
								->get();

		//Case of questions being null, send an empty array.
		$questions = $questions? $questions : [];

		//The same for related.
		$related = $related? $related : [];

		$isLoggedIn = Auth::check();

		//Check if the requester is the owner of the article.
		$isOwner = $article->isCurrentOwner();

		$isOfferted = false;

		if ($isLoggedIn) {
			$isOfferted = Offer::where('article_id', '=', $id)
							->where('user_id', '=', Auth::user()->id)
							->count();
		}


		return view('articles.show')
					->with('article', $article)
					->with('related', $related)
					->with('questions', $questions)
					->with('isLoggedIn', $isLoggedIn)
					->with('isOfferted', $isOfferted)
					->with('isOwner', $isOwner);

	}
}
