<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

use Request;

class AdminController extends Controller {

	public function __construct() {

		$this->middleware('authUser');
	}

	public function index()
	{
		return redirect()->route('admin.articles.index');
	}

	public function articlesList()
	{

		$articles = Article::with('category');

		if (Request::has('initialDate') && Request::has('finalDate')){

			$initialDate = Request::get('initialDate');
			$finalDate = Request::get('finalDate');

			if ( $finalDate <= $initialDate ) {
				return redirect()
							->route('admin.articlesList.index')
							->with('error', 'Rango de fechas inválido');
			}

			$articles = $articles->whereBetween('created_at', [$initialDate, $finalDate]);
		}

		if ( Request::has('active') ) {

			if ( Request::get('active') == 1 ){

				$articles = $articles->notFinished();

			} else if ( Request::get('active') == 0 ) {

				$articles = $articles->finished();
			}
		}

		$articles = $articles->get();

		return view('admin.articlesList.index')
						->with('articles', $articles);
	}

}
