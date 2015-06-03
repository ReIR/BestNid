<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Article extends Model {

	protected $table = 'articles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'title',
		'description',
		'image',
		'endDate',
		'user_id',
		'category_id'
	];

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


	public function user() {
		return $this->belongsTo('App\User');
	}

	public function category() {
		return $this->belongsTo('App\Category');
	}

	public function scopeOfCategory($query, $category) {
			return $query->join('categories', 'articles.category_id', '=', 'categories.id')
				->where('categories.name', '=', $category);
	}

	public function scopeNamed($query, $name) {
		return $query->where('title', 'LIKE', '%'.$name.'%');
	}

}
