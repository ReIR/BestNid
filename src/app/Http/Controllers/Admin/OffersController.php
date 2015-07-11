<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use DB;
use Auth;
use App\Article;
use App\Sale;
use App\Offer;
use Session;

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

		if ((Sale::alreadySold($article->id))){
			return redirect ()
						->route('home');
		}

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
	public function edit($article_id, $offer_id)
	{
		$article = Article::find($article_id);

		$offer = Offer::find($offer_id);

/*
		if ($offer == null || $article==null || ($offer->article_id != $article->id)){
			return redirect()
				->route('home')
				->with('error', 'Error 404: la página solicitada no existe');
		}
*/
		if (!$offer->isCurrentOwner()){
			return redirect()
				->route('admin.index')
				//Aquí está fallando ya que no muestra este mensaje cuando se envía.
				->with('error', 'Usted no tiene permisos para acceder a la url solicitada.');
		}

		return view('admin.offers.update')
				->with('offer', $offer)
				->with('article', $article);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$all= Request::all();
		$offer = Offer::find($all['id']);

		$all['user_id'] = $offer->user_id;
		$all['article_id'] = $offer->article_id;

		$validator = Offer::validate($all);

		if ($validator->fails()){
			$messages = $validator->messages();
			return redirect()
				->back()
				->with('errors', $messages);
		}

		$offer->update($all);

		return redirect()
				->back()
				->with('success', 'La oferta se actualizó correctamente');
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
