<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Auth;

class UsersController extends Controller {

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

		// redirecciona al home
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
