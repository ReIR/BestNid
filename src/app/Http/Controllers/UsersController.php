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
					/*
					 *	Laravel doesn't allow to use redirect()->intended to a POST/PUT/PATCH requested URL
					 *	beacuse redirect()->intended always'll send a GET request throwing an HTTPMethodNotAllowedException.
					 *	So I decided to trick it a little bit:
					 *	First I fetch the intended URL path.
					 *	Then I take the last word (being it the RESTful endpoint).
					 *	I check if the endpoint doesnt't correspond to a GET method. If it doesn't, then redirect to the index
					 *	because that means that a form was sent and it was lost!
					 *	Finally, if it does correspond to a GET method, redirect to the page they were trying to access.
					 *
					 *	Just to get this clear: This fix allowes to redirect to a GET endpoint when logging in,
					 *	avoiding the HTTPMethodNotAllowedException that could throw if the redirection was called from
					 *	an endpoint of another HTTP method.
					 */

						$intendedRoute = redirect()->intended('articles.index')->headers->allPreserveCase()["Location"][0];
						$resourceMethod = class_basename($intendedRoute);

						if($resourceMethod != 'index' && $resourceMethod != 'show' && $resourceMethod != 'create' && $resourceMethod != 'edit') {
							return redirect()->route('articles.index');
						}

						return redirect()->to($intendedRoute);

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
