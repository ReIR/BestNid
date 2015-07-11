<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// ---------------------------------
//	Pattern's validators
// ---------------------------------
//
Route::pattern('id', '[0-9]+'); // [0-9] sólo numeros; + al menos uno

// ---------------------------------
//	Root
// ---------------------------------
Route::get('/', ['as' => 'home', function(){
	return redirect()->route('articles.index');
}]);


// ---------------------------------
//	Admin Section
// ---------------------------------
//
Route::group(['prefix' => 'admin'], function(){

	// ---------------------------------
	//	Dashboard
	// ---------------------------------
	//
	Route::get('/', ['as' => 'admin.index', 'uses' => 'Admin\AdminController@index']);

	// ---------------------------------
	//	Articles
	// ---------------------------------
	//
	Route::resource('articles', 'Admin\ArticlesController');

	// ---------------------------------
	//	Questions
	// ---------------------------------
	//
	Route::resource('questions', 'Admin\QuestionsController');

	// ---------------------------------
	//	Edit User's Account
	// ---------------------------------
	//
	Route::get('account/edit', ['as' => 'admin.account.edit', 'uses' => 'Admin\AccountController@editAccount']);

	Route::patch('account', ['as' => 'admin.account.update', 'uses' => 'Admin\AccountController@updateAccount']);

	Route::get('account/password/edit', ['as' => 'admin.account.changePass','uses' => 'Admin\AccountController@getChangePassword']);
	Route::patch('account/password', ['as' => 'admin.account.updatePass','uses' => 'Admin\AccountController@updatePassword']);

	Route::get('account/offers', ['as' => 'admin.account.offers', 'uses' => 'Admin\AccountController@getOffers']);

	Route::get('account/questions', ['as' => 'admin.account.questions', 'uses' => 'Admin\AccountController@getQuestions']);

//	Route::resource('user', 'UsersController', ['except' => 'show', 'create', 'store']);
	// ---------------------------------
	//	Categories
	// ---------------------------------
	//
	Route::resource('categories', 'Admin\CategoriesController', ['except' => 'show']);

	Route::get('categories/alert/{id}',
		['as' => 'admin.categories.alert', 'uses' => 'Admin\CategoriesController@alert']);
});

// ---------------------------------
//	Articles
// ---------------------------------
//
Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show']]);

// ---------------------------------
//	Questions
// ---------------------------------
//
Route::resource('articles.questions', 'QuestionsController', ['only' => ['store', 'show']]);

// ---------------------------------
//	Answers
// ---------------------------------
//
Route::resource('articles.questions.answers', 'AnswersController', ['only' => ['store', 'show']]);

// ---------------------------------
//	Users
// ---------------------------------
//
Route::resource('users', 'UsersController', ['only' => ['create', 'store']]);



Route::get('users/login', [
	'as' => 'users.getLogin',
	'uses' => 'UsersController@getLogin'
]);

Route::post('users/login', [
	'as' => 'users.postLogin',
	'uses' => 'UsersController@postLogin'
]);

Route::get('users/logout', [
	'as' => 'users.logout',
	'uses' => 'UsersController@logout'
]);

// ---------------------------------
//	Offers
// ---------------------------------
//
Route::get('articles/{id}/offers/create', [
		'as' => 'articles.offers.create',
		'uses' => 'OffersController@create'
	]);

Route::get('articles/{id}/offers', [
		'as' => 'admin.articles.offers.index',
		'uses' => 'Admin\OffersController@index'
	]);

Route::post('articles/{id}/offers/store', [
		'as' => 'articles.offers.store',
		'uses' => 'OffersController@store'
	]);

Route::post('admin/articles/{id_article}/offers/{id_offer}/sales/store', [
		'as' => 'admin.articles.offers.sales.store',
		'uses' => 'Admin\SalesController@store'
	]);

Route::get('admin/article/{id_article}/offers/{id_offer}/edit', [
	'as' => 'admin.articles.offers.edit',
	'uses' => 'Admin\OffersController@edit'
	]);

Route::patch('admin/offers/{id}', [
	'as' => 'admin.offer.update',
	'uses' => 'Admin\OffersController@update'
	]);

Route::delete('admin/offers/{id}', [
		'as' => 'admin.offer.destroy',
		'uses' => 'Admin\OffersController@destroy'
	]);

Route::get('admin/offers/alert/{id}',
	['as' => 'admin.offer.alert', 'uses' => 'Admin\OffersController@alert']);

	// ---------------------------------
	//	Sales
	// ---------------------------------
	//
Route::get('admin/sales/index', [
		'as' => 'admin.sales.index',
		'uses' => 'Admin\SalesController@index'
	]);
