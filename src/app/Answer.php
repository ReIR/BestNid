<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Auth;

class Answer extends Model {

	protected $table = 'answers';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['text', 'user_id', 'question_id'];

	/**
	* The attributes that aren't mass assignable.
	*
	* @var array
	*/
	protected $guarded = ['*'];

	/**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	//protected $hidden = ['id'];

	protected $hidden = ['*'];

	/*
	| -----------------------------------------
	|	Validation Rules
	| -----------------------------------------
	|
	*/

	private static $rulesForCreation = [
		'text' => 'required|min:2|max:144',
		'user_id' => 'required|exists:users,id',
		'question_id' => 'required|exists:questions,id|unique:answers,question_id'
	];

	private static $messages = [
		// text messages
    'text.required' => 'La respuesta no puede estar vacía.',
		'text.min' => 'La respuesta debe tener al menos :min caracteres.',
		'text.max' => 'La respuesta debe tener menos de :max caracteres.',

		//User messages
		'user_id.required' => 'Es necesario que inicie sesión.',
		'user_id.exists' => 'Ese usuario no existe!',

		//Question messages
		'question_id.required' => 'Es necesario el la pregunta asociada a la respuesta.',
		'question_id.exists' => 'Esa pregunta no existe!',
		'question_id.unique' => 'Esa pregunta ya fue respondida!'
	];

	/*
	* Validate data $all
	*
	* @param $all answer data
	*
	* @return Validator
	*/
	public static function validate($all) {
		$rules = self::$rulesForCreation;
		$messages = self::$messages;

		return Validator::make($all, $rules, $messages);
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function question() {
		return $this->belongsTo('App\Question');
	}

	public function scopeOfUser($query, $user) {
		return $query->where('user_id', '=', $user);
	}

}
