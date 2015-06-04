<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Category extends Model {


	protected $fillable = ['name'];

	private static $rulesForCreation = [
			'name' => 'required|min:5|max:50|unique:categories,name'
	];

	public static function validate($all) {
		$rules = self::$rulesForCreation;

		return Validator::make($all, $rules);
	}

	public static function validateUpdate($all) {
		$rulestemp = self::$rulesForCreation;
		$rulestemp['name'] = 'required|min:5|max:50|unique:categories,name,'.$all['id'];

		return Validator::make($all, $rulestemp);
	}

	//
	public function articles() {
		return $this->hasMany('App\Article');
	}

}
