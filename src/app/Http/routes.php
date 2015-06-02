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

Route::get('/', ['as' => 'home', function(){
	return redirect()->route('articles.index');
}]);

// ---------------------------------
//	Pattern's validators
// ---------------------------------
//
Route::pattern('id', '[0-9]+'); // [0-9] sólo numeros; + al menos uno

// ---------------------------------
//	Root
// ---------------------------------
//
//Route::get('/', function(){
//	return redirect()->route('articles.index');
//});

// ---------------------------------
//	Articles
// ---------------------------------
//
Route::resource('articles', 'ArticlesController');

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
//	Categories
// ---------------------------------
//
Route::resource('categories', 'CategoriesController', ['except' => 'show']);

Route::resource('dashboard', 'DashboardController');

//Route::get('categories', [
//	'as' => 'categories', 
//	'uses' => 'CategoriesController@index'
//]);

//Route::get('categories/create', [
//	'as' => 'categories.create', 
//	'uses' => 'CategoriesController@create'
//]);
//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);