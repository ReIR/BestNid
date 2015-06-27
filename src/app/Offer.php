<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Validator;
use DB;
use Auth;

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
		'amount'=> 'required|numeric|min:0|digits_between:1,10',
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
		'amount.min' => 'El monto debe ser de al menos $:min',
		'amount.digits_between'=> 'El monto debe tener entre :min y :max dígitos',
		//Card messages
		'card.required'=> 'Se requiere un número de tarjeta.',
		'card.numeric'=> 'Solo deben ser números.',
		'card.digits_between'=> 'La tarjeta debe tener entre :min y :max dígitos',
		//Contact info (phone number)
		'contact.required'=> 'Se requiere información de contacto (número de tel.).',
		'contact.numeric'=> 'Solo debe contener números.',
		'contact.digits_between'=> 'El número de teléfono debe tener entre :min y :max dígitos.',
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
		return $this->belongsTo('App\User');
	}

	public function article()
	{
		return $this->belongsTo('App\Article');
	}

	public function getReason($limit = 30) {
		return Str::limit($this->text, $limit);
	}

	//Retorna la cantidad de ofertas que se han realizado a las publicaciones del usuario registrado.
	public static function offersInMyArticles(){
		return DB::table('articles')
							->join('offers', 'articles.id', '=', 'offers.article_id')
							->select('articles.title')
							->where ('articles.user_id', '=', Auth::user()->id)
							//Quedarme con aquellas subastas que han finalizado, alta paja.
							->count();
	}
}
