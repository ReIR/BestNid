<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use App\Article;
use App\Category;
use Session;
use Validator;
use Auth;

class ArticlesController extends Controller {


	public function __construct() {

		$this->middleware('authUser');
		$this->middleware('csrf', ['only' => 'store']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = new Article;

		$articles = $articles->isCurrentUserOwner();

		if ( Request::has('active') ) {

			if ( Request::get('active') == 1 ){

				$articles = $articles->notFinished();

			} else if ( Request::get('active') == 0 ) {

				$articles = $articles->finished();
			}
		}

		$articles = $articles->get();

		return view('admin.articles.index')
				->with('articles', $articles);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Article::getMapCategories();

		return view('admin.articles.create')->withCategories($categories);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Request::all();

		$validator = Article::validate($all);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->with('errors', $validator->messages())
				->with('warning', 'Vuelva a cargar la imagen.')
				->withInput();
		}

		Article::create($all);

		return redirect()
				->route('admin.articles.index')
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
		$article = Article::find($id);

		if (!$article) {
			Session::flash('error', 'No se encontró: '.$id);
		}

		return view('admin.articles.show')
					->with('article', $article);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categories = Article::getMapCategories();
		$article = Article::find($id);

		return view('admin.articles.edit')
						->withCategories($categories)
						->withArticle($article);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$all = Request::all();

		$article = Article::find($id);

		if(!$article) {
			abort(404);
		}

		if (!$article->isEditable()) {
			return redirect()
				->roite('admin.articles.index')
				->with('error', 'El artículo que quiso editar ya no es editable.');
		}

		$validator = Article::validateEdit($all);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->with('errors', $validator->messages())
				->withInput();
		}

		$article->update($all);

		return redirect()
				->route('admin.articles.index')
				->with('success', 'Se guardó correctamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function alert($id)
	{
		$article = Article::find($id);

		return view ('admin.articles.alert')
			->with('article', $article);
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
				->route('admin.articles.index')
				->with('success', 'El artículo fue borrado.');
	}

}
