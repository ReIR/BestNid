<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Offer extends Model {

	protected $table = 'offers';

	protected $guarded = ['_token'];

	/*
	| -----------------------------------------
	|	Validation Rules
	| -----------------------------------------
	|
	*/
	private static $rules = [
		'text'=> 'required|min:10',
		'amount'=> 'required|numeric',
		'card'=> 'required|numeric|digits_between:12,19',
		'contact'=> 'required|numeric|digits_between:6,20',
		'user_id'=>'required|exists:users,id',
		'article_id'=>'required|exists:articles,id'
	];

	private static $messages = [
		//Text's messages
		'text.required'=> 'La razón de la subasta es requerida.',
		'text.min'=> 'El texto debe tener más de :min caracteres',
		//Amount's messages
		'amount.required'=> 'El monto es requerido.',
		'amount.numeric' => 'Solo debe contener números.',
		//Card messages
		'card.required'=> 'Se requiere un número de tarjeta.',
		'card.numeric'=> 'Solo deben ser números.',
		//Contact info (phone number)
		'contact.required'=> 'Se requiere información de contacto (número de tel.).',
		'contact.numeric'=> 'Solo debe contener números.',
		'contact.min'=> 'El número de teléfono debe tener al menos :min dígitos ',
		'contact.max'=> 'El número de teléfono debe tener a lo sumo :max dígito.',
		//User messages
		'user_id.required' => 'El usuario es requerido',
		'user_id.exists' => '¡Ese usuario no existe!',
		//Article messages
		'article_id.required' => 'Es necesario el artículo asociado a la pregunta.',
		'article_id.exists' => '¡Ese artículo no existe!'
	];

	public static function validate($all) 
	{
		return Validator::make($all, self::$rules, self::$messages);
	}

	public function user()
	{
		return $this->hasOne('App\User');
	}

	public function article()
	{
		return $this->hasOne('App\Article');
	}

}
