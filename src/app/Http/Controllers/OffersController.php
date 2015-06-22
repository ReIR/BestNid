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

		return view('offers.create')
			->with('article', $article);
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
				->with('data', $data)
				->with('errors', $validator->messages());
		}

		$article = Article::find($id);
		//$users = DB::table('users')->where('user_id', '=', )->get();
		//dd($articles);

		if ( Auth::user()->id != $article->user_id )
		{
			Offer::create($data);
		}else {
			echo "Un usuario no puede ofertar sus propias subastas";
			die();
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
