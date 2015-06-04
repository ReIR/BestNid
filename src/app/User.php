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
	|	These fields are mass assignables
	| -----------------------------------------
	|
	*/
	protected $fillable = ['firstName','lastName','email','username'];

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
	|	Validation Rules
	| -----------------------------------------
	|
	*/

	private static $rulesForAdmin = [
		'firstName' => 'required|alpha|min:3|max:30',
		'lastName' => 'required|alpha|min:3|max:30',
		'email' => 'required|email|min:10|max:30|unique:users',
		'username' => 'required|min:4|max:16|unique:users',
		'password' => 'required|min:6',
		'rol' => 'required|in:user,admin'
	];

	private static $rulesForCreation = [
		'firstName' => 'required|alpha|min:3|max:30',
		'lastName' => 'required|alpha|min:3|max:30',
		'email' => 'required|email|min:10|max:30|unique:users',
		'username' => 'required|min:4|max:16|unique:users',
		'password' => 'required|min:6|same:repassword'
	];

	private static $messages = [
		// firstName messages
    'firstName.required' => 'El nombre es requerido',
		'firstName.alpha' => 'El nombre no puede contener números ni símbolos',
		'firstName.min' => 'El nombre debe tener al menos :min caracteres',
		'firstName.max' => 'El nombre debe tener menos de :max caracteres',
		// lastName messages
		'lastName.required' => 'El apellido es requerido',
		'lastName.alpha' => 'El apellido no puede contener números ni símbolos',
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
		$rules = self::$rulesForCreation;
		$messages = self::$messages;

		if ( self::currentUserIsAdmin() ) {
			$rules = self::$rulesForAdmin;
		}

		return Validator::make($all, $rules, $messages);
	}

	/*
	| -----------------------------------------
	|	Accesors & Mutators
	| -----------------------------------------
	|
	*/
	public function setPasswordAttribute($value)
  {
      $this->attributes['password'] = $value;
  }

	/*
	| -----------------------------------------
	|	Override methods
	| -----------------------------------------
	|
	*/
	public static function create(array $data) {

		$user = parent::create($data);

		$user->setPasswordAttribute(Hash::make($data['password']));

		$user->save();

		return $user;
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
