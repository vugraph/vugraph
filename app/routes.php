<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::resource('players', 'PlayersController');

Route::get('kullanici', 'UserController@getIndex');

/* Authorization functions like Login, Logout, Register, Activate, Forgot password, etc */
Route::get('giris', 'AuthController@getLogin');
Route::post('giris', 'AuthController@postLogin');
Route::get('cikis', 'AuthController@getLogout');
Route::get('kayit', 'AuthController@getRegistration');
Route::post('kayit', 'AuthController@postRegistration');

Route::controller('/', 'HomeController');