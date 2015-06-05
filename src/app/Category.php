<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Category extends Model {


	protected $fillable = ['name'];

	private static $rulesForCreation = [
			'name' => 'required|alpha|min:4|max:50|unique:categories,name'
	];

	public static function validate($all) {
		$rules = self::$rulesForCreation;
		$messages = self::$messages;

		return Validator::make($all, $rules, $messages);
	}

	public static function validateUpdate($all) {
		$rulestemp = self::$rulesForCreation;
		$messages = self::$messages;

		$rulestemp['name'] = 'required|alpha|min:4|max:50|unique:categories,name,'.$all['id'];

		return Validator::make($all, $rulestemp, $messages);
	}

	//
	public function articles() {
		return $this->hasMany('App\Article');
	}

	private static $messages = [
		// name messages
		'name.required' => 'El nombre es requerido',
		'name.alpha' => 'El nombre no puede contener números ni símbolos',
		'name.max' => 'El nombre debe tener menos de :max caracteres',
		'name.min' => 'El nombre debe tener al menos :min caracteres',

	];



}
