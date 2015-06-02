<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;

use App\Category;
use Session;
use Validator;
use Request;

class CategoriesController extends Controller {


	public function __construct() {

		$this->middleware('authUser', ['only' => ['create']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		echo 'sarasa index categories';
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view ('categories.create');		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$all = Request::all();

		$validator = Validator::make($all,
			['name' => ['required', 'unique:categories', 'min:5', 'max:50']]
		);

		if ( $validator->fails() ) 
		{
			$errors = $validator->errors()->all();

			return redirect()
				->back()
				->with('errors', $errors);
		}

		Category::create($all);

		return redirect()
				->route('categories.index')
				->with('success', 'Se guardó correctamente');	}

	/**
	 * Display the specified Category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$category = Category::find($id);

		if (!$category) {
			Session::flash('error', 'No se encontró: '.$id);
		}

		return view('categories.show')
					->with('category', $category);
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
//		Article::destroy($id);
//
//		return redirect()
//				->route('categories.index')
//				->with('success', 'El artículo fue borrado.');
	}
}
