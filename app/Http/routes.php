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

Route::get('/', function () {
    return view('welcome');
});


Route::get(	'/', 		'PagesController@create');
Route::get(	'/about', 	'PagesController@about');
Route::get(	'/home', 	'PagesController@home');
Route::get(	'/create', 	'PagesController@create');
Route::post('/create', 	'PagesController@create');

Route::get('/view/{baconName}', 	'PagesController@view');

// Catch all for public URLs
Route::get('{baconName}',			'PagesController@view');
