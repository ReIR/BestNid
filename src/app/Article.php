<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $table = 'articles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	//protected $guarded = ['rol'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = ['id'];


	public function user() {
		return $this->belongsTo('App\User');
	}

}
