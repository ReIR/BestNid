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
//
Route::get('/', 'WelcomeController@index');

// ---------------------------------
//	Articles
// ---------------------------------
//
Route::resource('articles', 'ArticlesController');

// ---------------------------------
//	Users
// ---------------------------------
//
Route::resource('users', 'UsersController', ['only' => ['create']]);

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

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);