<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;
use App\Article;

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

		$questions = Question::with('article')
									->ofUser(Auth::user()->id)
									->notAnswered()
									->get();

		$answeredQuestions = Question::with('article')
									->ofUser(Auth::user()->id)
									->answered()
									->get();

		return view('admin.questions.index')
				->with('questions', $questions)
				->with('answeredQuestions', $answeredQuestions);
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
	public function store($article_id)
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
