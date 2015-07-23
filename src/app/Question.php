<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Validator;
use Auth;

class Question extends Model {

	protected $table = 'questions';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['text', 'user_id', 'article_id'];

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
		'text' => 'required|min:10|max:144',
		'user_id' => 'required|exists:users,id',
		'article_id' => 'required|exists:articles,id'
	];

	private static $messages = [
		// text messages
    'text.required' => 'La pregunta no puede estar vacía.',
		'text.min' => 'La pregunta debe tener al menos :min caracteres.',
		'text.max' => 'La pregunta debe tener menos de :max caracteres.',

		//User messages
		'user_id.required' => 'Es necesario que inicie sesión.',
		'user_id.exists' => 'Ese usuario no existe!',

		//Article messages
		'article_id.required' => 'Es necesario el artículo asociado a la pregunta.',
		'article_id.exists' => 'Ese artículo no existe!'
	];

	/*
	* Validate data $all
	*
	* @param $all question data
	*
	* @return Validator
	*/
	public static function validate($all) {
		$rules = self::$rulesForCreation;
		$messages = self::$messages;

		return Validator::make($all, $rules, $messages);
	}

	public static function countMyPendingQuestions() {
		return Question::ofUser(Auth::user()->id)
									->notAnswered()
									->count();
	}

	public static function countMyAnsweredQuestions() {
		return Question::ofUser(Auth::user()->id)
									->answered()
									->count();
	}

	public static function countMyArticlesQuestions() {

		$myArticles = Article::isCurrentUserOwner()->select('id')->get();
		$questions = Question::whereIn('article_id', $myArticles->toArray());

		return $questions->count();
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function article() {
		return $this->belongsTo('App\Article');
	}

	public function answer() {
		return $this->hasOne('App\Answer');
	}

	public function isAnswered() {
		return ($this->answer()->first() || false);
	}

	public function scopeOfArticle($query, $article) {
		return $query->where('questions.article_id', '=', $article);
	}

	public function scopeOfUser($query, $user) {
		return $query->where('questions.user_id', '=', $user);
	}

	public function scopeNotAnswered($query) {
		//TO BE FILLED
		return $query->leftJoin('answers', 'questions.id', '=', 'answers.question_id')
			->whereNull('answers.question_id')
			->select(
				'questions.id as id',
				'questions.text as text',
				'questions.user_id as user_id',
				'questions.article_id as article_id',
				'questions.created_at as created_at',
				'answers.id as answer_id',
				'answers.text as answer_text',
				'answers.user_id as answer_user_id'
			);
	}

	public function scopeAnswered($query) {

		return $query->join('answers', 'questions.id', '=', 'answers.question_id')
			->select(
				'questions.id as id',
				'questions.text as text',
				'questions.user_id as user_id',
				'questions.article_id as article_id',
				'answers.id as answer_id',
				'answers.text as answer_text',
				'answers.user_id as answer_user_id',
				'answers.created_at as created_at'
			);
	}

}
