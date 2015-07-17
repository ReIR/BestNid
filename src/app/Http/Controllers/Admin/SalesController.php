<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sale;
use App\Article;
use Request;
use App\Offer;

class SalesController extends Controller {

	public function __construct() {
		$this->middleware('authUser');
	}

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

				if ( $finalDate < $initialDate ) {
					return redirect()
									->route('admin.sales.index')
									->with('error', 'Rango de fechas inválido');
				}

				if ( ! \App\User::currentUserIsAdmin() ) {

					$salesBetween= Sale::salesOfUser()
									->whereBetween('date', [$initialDate, $finalDate])
									->get();
				} else {

					$salesBetween= Sale::whereBetween('date', [$initialDate, $finalDate])
									->get();
				}

				return view('admin.sales.index')
							->with('mySales', $salesBetween);
		}

		if ( ! \App\User::currentUserIsAdmin() ) {
			$sales = Sale::salesOfUser()->get();
		} else {
			$sales = Sale::all();
		}

		return view('admin.sales.index')
					->with('mySales', $sales);
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
	public function store($article_id, $offer_id)
	{
		$offer = Offer::find($offer_id);
		
		$data = Request::all();
		$data['user_id'] = $offer->user_id;
		$data['offer_id'] = $offer_id;
		$data['article_id'] = $article_id;

		$validator = Sale::validate($data);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->withInput()
				->with('errors', $validator->messages());
		}

		$hasBeenOferted = Sale::where('article_id', '=', $article_id)->count();

		if ( $hasBeenOferted )
		{
			return redirect()
				->route('admin.articles.index')
				->with('error', 'Usted ya ha elegido una oferta ganadora para el artículo solicitado.');
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
