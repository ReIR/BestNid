<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Support\Str;

use Request;
use Auth;
use Validator;
use Hash;
use Image;
use Carbon\Carbon;

class Article extends Model {

	protected $table = 'articles';

	private static $rules = [
		'title' => 'required|min:4|max:50',
		'description' => 'required|min:10',
		'image' => 'required|image|mimes:jpeg,jpg,png',
		'endDate' => 'required',
		'category_id' => 'required|integer|exists:categories,id'
	];

	private static $messages = [
    'title.required' => 'El título es requerido',
		'title.min' => 'El título debe tener más de :min caracteres',
		'title.max' => 'El título debe tener menos de :max caracteres',
		'description.required' => 'La descripción es requerida',
		'description.min' => 'La descripción debe tener más de :min caracteres',
		'image.required' => 'La imagen es requerida',
		'image.image' => 'El archivo adjunto no es una imagen',
		'image.mimes' => 'La imagen no es un formato válido. Debe ser jpeg, jpg ó png',
		'image.size' => 'La imagen debe tener un tamaño menor a :size KB',
		'endDate.required' => 'La fecha de finalización es requerida',
		'endDate.after' => 'La fecha de finalización debe ser de al menos 15 días',
		'endDate.date' => 'La fecha de finalización tiene un formato incorrecto',
		'category_id.required' => 'La categoría es requerida',
		'category_id.integer' => 'La categoría es requerida',
		'category_id.exists' => 'La categoría no es un valor válido'
	];

	/*
	* Validate data $all
	*
	* @param $all article data
	*
	* @return Validator
	*/
	public static function validate($all) {

		$rules = self::$rules;

		$after15days = date('m/d/Y', strtotime("+14 days"));

		$all['endDate'] = date('m/d/Y', strtotime($all['endDate']));

		$rules['endDate'] .= '|after:'.$after15days;

		return Validator::make($all, $rules, self::$messages);
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'user_id',
		'title',
		'description',
		'image',
		'endDate',
		'category_id',
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

	public function questions() {
		return $this->hasMany('App\Question');
	}

	public function offers() {
		return $this->hasMany('App\Offer');
	}

	public function sale() {
		return $this->hasOne('App\Sale');
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

	public function scopeNotFinished($query) {
		return $query->where('endDate', '>', date("Y-m-d"));
	}

	public function scopeFinished($query) {
		return $query->where('endDate', '<=', date("Y-m-d"));
	}

	public function scopeIsCurrentUserOwner($query) {
		return $query->where('user_id', '=', Auth::user()->id);
	}

	public function getImageURL(){
		return asset( self::getImagesPath() . $this->image);
	}

	public function getDescription($limit = 100) {
		return Str::limit($this->description, $limit);
	}

	public function getTitle($limit = 20) {
		return Str::limit($this->title, $limit);
	}

	public function getRemainingDays() {
		$today = new \DateTime();
		$end = new \DateTime($this->endDate);
		$diff = $today->diff($end);
		$diff = $diff->format("%r%a");

		return ( $diff > 0 ) ? $diff : 0;
	}

	public function toBeFinished() {

		// Finished, has offers and is not sold.

		return ( !$this->isActive() && $this->offers->count() && !$this->sale );
	}

	public function isCurrentOwner() {
		return (Auth::check() && (Auth::user()->id == $this->user_id));
	}

	public function isActive() {
		return ( $this->getRemainingDays() > 0 );
	}

	/*
	| -----------------------------------------
	|	Return path for persist images
	| -----------------------------------------
	|
	*/
	private static function getImagesFullPath(){
		return public_path() . '/images/articles/';
	}

	private static function getImagesPath(){
		return 'images/articles/';
	}

	/*
	| -----------------------------------------
	|	Convert and persist images
	| -----------------------------------------
	|
	*/
	public static function savePhoto($file) {
		$name = md5(microtime());
		$name .= '.jpg';

		$img = Image::make($file)->resize(640, 480)->encode('jpg', 100);

		$img->save( self::getImagesFullPath() . $name);

		return $name;
	}

	/*
	| -----------------------------------------
	|	Get categories for FORM
	| -----------------------------------------
	|
	*/
	public static function getMapCategories(){
		$categories = [];
		$categories[] = '';

		foreach(Category::all() as $c){
			$categories[$c->id] = $c->name;
		}

		return $categories;
	}

	/*
	| -----------------------------------------
	|	Override methods
	| -----------------------------------------
	|
	*/
	public static function create(array $data) {

		// Assign user_id and save image
		$data['user_id'] = Auth::user()->id;
		$data['image'] = self::savePhoto($data['image']);

		return parent::create($data);
	}

}
