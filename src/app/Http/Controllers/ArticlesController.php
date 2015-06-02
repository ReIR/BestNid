<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use App\Article;
use Session;
use Validator;

class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if ( Request::has('q') ) {

			$q = Request::get('q');

			$articles = Article::where('name', 'LIKE', '%'.$q.'%')->get();

			if (!count($articles)) 
			{
				return redirect()
					->route('articles.index')
					->with('error', 'Artículo '.$q.' no encontrado');
			}

		} else {

			$articles = Article::all();
		}


		return view('articles.index')
				->with('articles', $articles);
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

		return view('articles.show')
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
