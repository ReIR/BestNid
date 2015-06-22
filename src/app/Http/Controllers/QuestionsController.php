<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;

use Request;
use Auth;

class QuestionsController extends Controller {

	public function __construct() {
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
		//Get all params.
		$data = Request::all();

		//Get the id of the asker. Add it to the params array.
		$data['user_id'] = Auth::user()->id;

		$validator = Question::validate($data);

		if($validator->fails()) {

			$error = $validator->errors()->first();

			return redirect()
				->back()
				->with('error', $error);
		}

		Question::create($data);

		return redirect()
			->route('articles.show', ['id' => $data["article_id"]]);
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
