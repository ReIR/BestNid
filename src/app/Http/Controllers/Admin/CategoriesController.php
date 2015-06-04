<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;

use App\Category;
use App\Article;
use Session;
use Validator;
use Request;

class CategoriesController extends Controller {


	public function __construct() {
		$this->middleware('authAdmin');
		$this->middleware('csrf', ['only' => ['store', 'destroy', 'update']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$categories = Category::all();

		return view('admin.categories.index')
				->with('categories', $categories);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view ('admin.categories.create');
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
				->route('admin.categories.index')
				->with('success', 'Se guardó correctamente');
	}

	/**
	 * Display the specified Category.
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
		$category = Category::find($id);

		if (!$category)
			abort(404, 'No Encontrado');

		if ( $category->articles->count() > 0 )
		{
			return redirect()
				->route('admin.categories.index')
				->with('error', 'La categoría '. $category->name . ' no puede ser borrada porque tiene artículos asociados.');
		}

		Category::destroy($id);

		return redirect()
			->route('admin.categories.index')
			->with('success', 'La categoría '. $category->name . ' fue borrada.');
	}

	public function alert ($id){

		$category = Category::find($id);

		return view ('admin.partials.alert')
			->with('category', $category)
			->with('message', '¿Desea eliminar la categoría '. $category->name.'?');
	}
}
