<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Article;
use Request;
use App\Offer;

class OffersController extends Controller {


	public function __construct(){
		$this->middleware('authUser');
		$this->middleware('csrf', ['only' => ['store', 'destroy', 'update']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$article= Article::find($id);

		if (!$article->isCurrentOwner())
		{
			return view('offers.create')
				->with('article', $article);
		}
		return redirect()
				->route('articles.show', ['id'=> $article->id]);
				

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$data = Request::all();
		$data['article_id'] = $id;		
		$data['user_id'] = Auth::user()->id;

		$validator = Offer::validate($data);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->withInput()
				->with('errors', $validator->messages());
		}

		$article = Article::find($id);
		
		if ( (Auth::user()->id == $article->user_id) || (Auth::user()->alreadyOffered($id)) )
		{
			return redirect()
				->route('articles.index')
				->with('error', 'Este usuario ya ofertó en esta subasta.');

		}else {

			Offer::create($data);
		}

		return redirect()
				->route('articles.index')
				->with('success','Se ha enviado la oferta con éxito.');
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
