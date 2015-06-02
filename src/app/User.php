<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Auth;
use Validator;
use Hash;

class User extends Model implements Authenticatable {

	/*
	| -----------------------------------------
	|	This trait implement abstract methods
	| -----------------------------------------
	|
	*/
	use AuthenticableTrait;

	/*
	| -----------------------------------------
	|	Validation Rules
	| -----------------------------------------
	|
	*/

	private static $rulesForAdmin = [
		'firstName' => 'required|min:3|max:30',
		'lastName' => 'required|min:3|max:30',
		'email' => 'required|min:10|max:30|unique:users',
		'username' => 'required|min:4|max:16|unique:users',
		'password' => 'required|min:6',
		'rol' => 'required|in:user,admin'
	];

	private static $rulesForCreation = [
		'firstName' => 'required|min:3|max:30',
		'lastName' => 'required|min:3|max:30',
		'email' => 'required|min:10|max:30|unique:users',
		'username' => 'required|min:4|max:16|unique:users',
		'password' => 'required|min:6',
		'repassword' => 'required|same:password',
	];

	/*
	* Validate data $all, depending of current
	* user role
	*
	* @param $all user data
	*
	* @return Validator
	*/
	public static function validate($all) {
		$rules = self::$rulesForCreation;

		if ( self::currenUserIsAdmin() ) {
			$rules = self::$rulesForAdmin;
		}

		return Validator::make($all, $rules);
	}

	/*
	| -----------------------------------------
	|	Override methods
	| -----------------------------------------
	|
	*/
	public static function create(array $data) {
		
		$data['password'] = Hash::make($data['password']);

		return parent::create($data);
	}

	/*
	| -----------------------------------------
	|	These fields are mass assignables
	| -----------------------------------------
	|
	*/
	protected $fillable = ['firstName','lastName','email','username','password'];

	/*
	| -----------------------------------------
	|	These fields are not mass assignables
	| -----------------------------------------
	|
	*/
	protected $guarded = ['*'];

	/*
	| -----------------------------------------
	|	These fields are hidden in response
	| -----------------------------------------
	|
	*/
	protected $hidden = ['password', 'remember_token'];

	/*
	| -----------------------------------------
	|	Relationships with Articles
	| -----------------------------------------
	|
	*/
	public function articles() {
		return $this->hasMany('App\Article');
	}

	/*
	| -----------------------------------------
	|	Helper methods
	| -----------------------------------------
	|
	*/
	public function getFullName() {
		return $this->firstName . ' ' . $this->lastName;
	}

	public static function currentUserIsAdmin() {

		// Verify if user authenticated, is admin.

		return ( (Auth::check()) && (Auth::user()->role === 'admin') );
	}
}
