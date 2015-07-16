<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;

class UsersController extends Controller {


	public function __construct() {
		$this->middleware('authAdmin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
		public function index()
		{
			if (Request::has('initialDate') && Request::has('finalDate')){

					$initialDate = Request::get('initialDate');
					$finalDate = Request::get('finalDate');

					// check if is a bad range of dates
					if ( $finalDate < $initialDate ) {
						return redirect()
										->route('admin.users.index')
										->with('error', 'Rango de fechas inválido');
					}

					$usersBetween= User::whereBetween('created_at', [$initialDate, date('Y-m-d', strtotime('+1 days'.$finalDate))])->get();

					return view('admin.users.index')
								->with('users', $usersBetween);
			}

			$users = User::all();
			return view ('admin.users.index')
						->with('users', $users);
		}

}
