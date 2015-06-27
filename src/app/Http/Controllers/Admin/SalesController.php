<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Article;
use Request;

class SalesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Request::has('initialDate') && Request::has('finalDate')){

				$initialDate = Request::get('initialDate');
				$finalDate = Request::get('finalDate');

				$salesBetween= Sale::salesOfUser()
									->whereBetween('date', [$initialDate, $finalDate])
									->get();

				return view('admin.sales.index')
							->with('mySales', $salesBetween);
	//	}elseif (Request::has('initialDate')) {
			# se requiere fecha final.
	//	}elseif (Request::has('finalDate')) {
			# se requiere fecha inicial
		}

		$mySales = Sale::salesOfUser()
								->get();

		return view('admin.sales.index')
					->with('mySales', $mySales);
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
		$data = Request::all();
		$data['date'] = date('Y-m-d', strtotime(date('Y-m-d')));
		$article = Article::find($data['article_id']);
		$validator = Sale::validate($data);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->withInput()
				->with('errors', $validator->messages());
		}

		if (!(Sale::where('article_id', '=', $data['article_id'])->count() == 0 ))
		{
			return redirect()
				->route('admin.articles.index')
				->with('error', 'Usted ya ha elegido una oferta ganadora para '. $article->title . '.');
		}

		Sale::create($data);
		
		return redirect()
				->route('admin.articles.index')
				->with('success','La transacción se ha hecho correctamente. Se notificará al ganador vía e-mail.');
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
