<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Offer;
use App\Article;
use App\Question;
use Request;
use Hash;
use DB;

//use Illuminate\Http\Request;

class AccountController extends Controller {

	public function __construct() {
		$this->middleware('authUser');
		$this->middleware('csrf', ['only' => ['updateAccount', 'updatePassword', 'destroy']]);
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

	public function getOffers() {
		return view('admin.account.offers')->withOffers( Auth::user()->offers );
	}

	public function getQuestions() {

		$myArticles = Article::isCurrentUserOwner()->select('id')->get();
		$questions = Question::whereIn('article_id', $myArticles->toArray());

		if ( Request::has('answered') ) {

			if ( Request::get('answered') == 1 ){

				$questions = $questions->answered();

			} else if ( Request::get('answered') == 0 ) {

				$questions = $questions->notAnswered();
			}
		}

		$questions = $questions->get();

		return view('admin.account.questions')->withQuestions( $questions );
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

		Auth::user()->update($data);

		return redirect()
			->route('admin.account.edit')
			->with('success', 'La información se ha guardado correctamente.');
	}

	public function getChangePassword() {

		return view('admin.account.change-pass')->withUser(Auth::user());
	}

	public function updatePassword() {

		$data = Request::all();

		if ( ! Hash::check($data['password'], Auth::user()->password) ) {
			return redirect()
				->back()
				->with('error', 'La contraseña actual no es correcta');
		}

		$validator = User::validatePassword($data);

		if ( $validator->fails() ) {
			return redirect()
				->back()
				->with('errors', $validator->messages());
		}

		Auth::user()->update([
			'password' => Hash::make($data['newpassword'])
		]);

		return redirect()
			->route('articles.index')
			->with('success', 'Contraseña actualizada!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$user_id = Auth::user()->id;

		// get auctions with offers
		$articles = DB::table('articles');
		$articles->leftJoin('offers', 'articles.id', '=', 'offers.article_id')
				// owner
				->where('articles.user_id', '=', $user_id)
				// where
				//  - not finished auctions
				//  or
				//  - not have set a winner
				->where(function($query){
					$query->where('articles.endDate', '>', DB::raw('NOW()'))
								->orWhereNotExists(function($query){
					      	$query->select('id')
									      ->from('sales')
										    ->whereRaw('sales.offer_id = offers.id');
								});
				});

		// if exist an auction, can't delete.
		$canDelete = $articles->count() ? false : true;

		if ( ! $canDelete ) {
			return redirect()
				->back()
				->withError('No se puede eliminar la cuenta ya que usted cuenta con subastas activas o sin elección de ganador');
		}

		try {
			// deactivate user
			User::deactivateCurrentUser();

		} catch (\Exception $e) {
			return redirect()
				->back()
				->withError($e->getMessage());
		}

		return redirect()
						->route('users.getLogin')
						->with('info', 'Cuenta desactivada. Vuelve pronto :(');
	}

}
