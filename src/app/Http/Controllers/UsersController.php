<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Auth;
use App\User;

class UsersController extends Controller {

	public function __construct() {
		$this->middleware('csrf', ['only' => ['store', 'postLogin', 'update', 'destroy']]);
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
	 * Show login form
	 *
	 * @return View
	 */
	public function getLogin()
	{
		if ( Auth::check() ) {
			return redirect()->route('articles.index');
		}

		return view('users.login');
	}

	/**
	 * Authemticate user
	 *
	 * @return Response
	 */
	public function postLogin()
	{
		// Autentica el usuario

		$username = Request::input('username');
		$password = Request::input('password');

		if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->route('articles.index');

        } else {

        	return redirect()->back()->with('error', 'Credenciales inválidas');
        }
	}

	/**
	 * Logout user
	 *
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();

		return redirect()
			->route('articles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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

		$user = User::create($data);

		return redirect()
				->route('users.getLogin')
				->with('success','Bienvenido! '.$user->getFullName().' Ahora debes iniciar sesión.');
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
	public function edit()
	{
	/**
	*	$id = Auth::user()->id;
	*	$user = User::find($id);
	*	return view('users.update')
	*		->with('user', $user);
	*/
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
