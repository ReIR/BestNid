<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use App\Article;
use Session;
use Validator;

class ArticlesController extends Controller {


	public function __construct() {

		$this->middleware('authUser', ['only' => ['create']]);
	}

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
			$articles = $articles->ofCategory(Request::get('cat'));
		}

		//Query for the name in the results from before.
		if ( Request::has('q')) {
			$articles = $articles->named(Request::get('q'));
		}
		//dd($articles);
		//Here is when the query is actualy run.
		$articles = $articles->get();

		//Check for results.
		if (!count($articles))
		{
			return redirect()
				->route('articles.index')
				->with('error', 'No se han encontrado artículos que cumplan las condiciones de búsqueda.');
		}

		return view('articles.index')
				->with('articles', $articles);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Request::all();

		$validator = Validator::make($all,
			['name' => ['required', 'min:5', 'max:50']]
		);

		if ( $validator->fails() )
		{
			$errors = $validator->errors()->all();

			return redirect()
				->back()
				->with('errors', $errors);
		}

		Article::create($all);

		return redirect()
				->route('articles.index')
				->with('success', 'Se guardó correctamente');
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
		$related = Article::with('category')->ofCategory($article->category->id)->take(3)->get();

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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Article::destroy($id);

		return redirect()
				->route('articles.index')
				->with('success', 'El artículo fue borrado.');
	}

}
