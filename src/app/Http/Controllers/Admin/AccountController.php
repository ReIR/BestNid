<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Request;

//use Illuminate\Http\Request;

class AccountController extends Controller {

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
	public function editAccount()
	{
		
		$id = Auth::user()->id;
		$user = User::find($id);
		return view('admin.account.update')
			->with('user', $user);

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

	public function updateAccount ()
	{
		$data = Request::all();
		$validator = User::validate($data);

		if ( $validator->fails() )
		{
			return redirect()
				->back()
				->with('data', $data)
				->with('errors', $validator->messages());
		}
		//Aún resta guardar la información que se vaya a modificar. Este es el lugar para hacerlo.
		Auth::user()->update($data);

		return redirect()
			->route('admin.index')
			->with('success', 'La información se ha guardado correctamente.');
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
