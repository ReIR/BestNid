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
		return $query->where('category_id', '=', $category);
	}

	public function scopeOfNamedCategory($query, $category) {
			return $query->join('categories', 'articles.category_id', '=', 'categories.id')
				->where('categories.name', '=', $category)
				->select(
					'articles.id as id',
					'articles.title as title',
					'articles.description as description',
					'articles.image as image',
					'articles.endDate as endDate',
					'articles.user_id as user_id',
					'articles.category_id as category_id',
					'articles.created_at as created_at',
					'articles.updated_at as updated_at',
					'categories.name as category_name'
				);
	}

	public function scopeNamed($query, $name) {
		return $query->where('title', 'LIKE', '%'.$name.'%');
	}

	public function getImageURL(){
		return asset('images/'.$this->image);
	}

}
