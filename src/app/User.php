<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Auth;
use Validator;
use Hash;
use Request;
use DB;

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
	|	These fields are mass assignables
	| -----------------------------------------
	|
	*/
	protected $fillable = ['firstName','lastName','email','username','password'];

	/*
	| -----------------------------------------
	|	These fields are hidden in response
	| -----------------------------------------
	|
	*/
	protected $hidden = ['password', 'remember_token'];

	/*
	| -----------------------------------------
	|	Validation Rules
	| -----------------------------------------
	|
	*/

	private static $rules = [
		'firstName' => 'required|regex:/^[\pL\s]+$/u|min:3|max:30',
		'lastName' => 'required|regex:/^[\pL\s]+$/u|min:3|max:30',
		'email' => 'required|email|min:10|max:30|unique:users,email',
		'username' => 'required|min:4|max:16|unique:users,username',
		'password' => 'required|min:6|same:repassword'
	];

	private static $messages = [
		// firstName messages
    	'firstName.required' => 'El nombre es requerido',
		'firstName.regex' => 'El nombre no puede contener números ni símbolos',
		'firstName.min' => 'El nombre debe tener al menos :min caracteres',
		'firstName.max' => 'El nombre debe tener menos de :max caracteres',
		// lastName messages
		'lastName.required' => 'El apellido es requerido',
		'lastName.regex' => 'El apellido no puede contener números ni símbolos',
		'lastName.min' => 'El apellido debe tener al menos :min caracteres',
		'lastName.max' => 'El apellido debe tener menos de :max caracteres',
		// email messages
		'email.required' => 'El email es requerido',
		'email.email' => 'El email no es una dirección de correo electrónica válida',
		'email.min' => 'El email debe tener al menos :min caracteres',
		'email.max' => 'El email debe tener menos de :max caracteres',
		'email.unique' => 'Un usuario con este email, ya se encuentra registrado',
		// username messages
		'username.required' => 'El nombre de usuario es requerido',
		'username.min' => 'El nombre de usuario debe tener al menos :min caracteres',
		'username.max' => 'El nombre de usuario debe tener menos de :max caracteres',
		'username.unique' => 'Un usuario con este nombre de usuario, ya se encuentra registrado',
		// password messages
		'password.required' => 'La contraseña es requerida',
		'password.min' => 'La contraseña debe tener al menos 6 caracteres',
		'password.same' => 'Las contraseñas no coinciden'
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
		$rules = self::$rules;
		$messages = self::$messages;
		$method = Request::method();

		if ($method == 'PATCH' || $method == 'PUT') {
			unset($rules['password']);
			$rules['email'] = $rules['email'] .','.Auth::user()->id;
			$rules['username'] = $rules['username'] .','.Auth::user()->id;
		}

		return Validator::make($all, $rules, $messages);
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
	|	Relationships with Articles
	| -----------------------------------------
	|
	*/
	public function articles() {
		return $this->hasMany('App\Article');
	}

		/*
	| -----------------------------------------
	|	Relationships with Offers
	| -----------------------------------------
	|
	*/
	public function offers() {
		return $this->hasMany('App\Offer');
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

	public function alreadyOffered($id){
		$offers = DB::table('offers')
					->where('article_id', '=', $id)
					->where( 'user_id', '=', Auth::user()->id)->get();
		return !empty($offers);
	}

}
