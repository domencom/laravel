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

Route::get('/', 'GeoCodeController@index');

Route::get('home', 'HomeController@index');
Route::get('auth', ['middleware' => 'auth', 'Auth\AuthController@index']);
Route::get('hello', 'WelcomeController@hello');
Route::get('about', 'PagesController@about');
Route::get('tasks', 'TasksController@tasks');
Route::post('tasks/add', 'TasksController@add');
Route::delete('task/{id}', 'TasksController@task');
Route::get('task/{id}/edit', 'TasksController@edit');
Route::patch('task/{id}/update', 'TasksController@update');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
