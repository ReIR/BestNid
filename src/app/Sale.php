<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;
use Auth;

class Sale extends Model {

	protected $table = 'sales';
	protected $guarded = ['_token'];

	private static $rulesForCreation = [
		'user_id' => 'required|exists:users,id',
		'article_id' => 'required|exists:articles,id',
		'offer_id' => 'required|exists:offers,id'
	];

	private static $messages = [
		'user_id.required' => 'El usuario es requerido.',
		'user_id.exists' => 'El usuario no existe.',
		'article_id.required' => 'El artículo es requerida.',
		'article_id.exists' => 'El artículo no existe.',
		'offer_id.required' => 'La oferta es requerida.',
		'offer_id.exists' => 'La oferta no existe.'
	];


	public static function validate($all) {
		$rules = self::$rulesForCreation;
		$messages = self::$messages;

		return Validator::make($all, $rules, $messages);
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function article(){
		return $this->belongsTo('App\Article');
	}

	public function offer(){
		return $this->belongsTo('App\Offer');
	}

	public static function alreadySold($id){
		return !(self::where('article_id', '=', $id)->count() == 0 );
	}

	public function scopeSalesOfUser($query){
		return $query
						->join('articles', 'articles.id', '=', 'sales.article_id')
						->select('*')
						->where('articles.user_id', '=', Auth::user()->id);
	}

	public static function countMySales(){
		if (! \App\User::currentUserIsAdmin() ) {
			$sales = self::salesOfUser()->count();
		} else {
			$sales = self::count();
		}

		return $sales;
	}

	public function getIncome() {
		return $this->offer->amount * 0.3;
	}
}
