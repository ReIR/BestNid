<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;
use App\Article;

class OffersController extends Controller {

	public function __construct() {
		$this->middleware('authUser');
		//$this->middleware('csrf', ['only' => ['store', 'destroy', 'update']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{

		$article = Article::find($id);
/*		$myArticles = DB::table('articles')
			->join('offers', 'articles.id', '=', 'offers.article_id')
			->select('articles.id', 'articles.title', 'articles.user_id', 'articles.category_id')
			->where ('articles.user_id', '=', Auth::user()->id)
			//Quedarme con aquellas subastas que han finalizado, alta paja.
			->get();

		$myOffers = DB::table('articles')
			->join('offers', 'articles.id', '=', 'offers.article_id')
			->select('articles.title', 'articles.id')
			->where('offers.user_id', '=', Auth::user()->id)
			->get();
*/
		$offers = DB::table('offers')
			->where('offers.article_id', '=', $id)
			->get();

		if (!$article->isCurrentOwner()){
			return redirect()
				->back()
				->with('error', 'Usted no tiene permisos para acceder a la url solicitada.');
		}

		return view('admin.offers.index')
				->with ('offers', $offers)
				->with('article', $article);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		//
	}

}
