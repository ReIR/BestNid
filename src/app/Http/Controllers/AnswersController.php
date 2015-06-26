<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Answer;
use App\Question;
use App\Article;

use Request;
use Auth;

class AnswersController extends Controller {

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
	public function store($article_id, $question_id)
	{

		$article = Article::find($article_id);

		//Ensure that the owner is the one answering questions.
		if(!$article->isCurrentOwner()) {

			return redirect()
				->back()
				->with('error', 'El dueño del artículo es el único que puede responder preguntas sobre sus artículos.');
		}

		if(!$article->isActive()) {

			return redirect()
				->back()
				->with('error', 'No se pueden responder preguntas sobre artículos que ya han finalizado.');
		}

		$question = Question::find($question_id)
			->with('article')
			->first();

		//Check that the form wasnt adulterated.
		if($question->article->id != $article_id) {
			return redirect()
				->back()
				->with('error', 'La respuesta que estas queriendo agregar no se corresponde con la pregunta.');
		}

		$data['user_id'] = Auth::user()->id;
		$data['question_id'] = $question_id;
		$data['text'] = Request::get('text');

		$validator = Answer::validate($data);

		if($validator->fails()) {

			$error = $validator->errors()->first();

			return redirect()
				->back()
				->with('error', $error);
		}

		Answer::create($data);

		return redirect()
			->route('articles.show', ['id' => $article_id])
			->with('success', 'La pregunta se agregó correctamente.');
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
