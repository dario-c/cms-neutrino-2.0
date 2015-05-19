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

// Frontend Routing
Route::get('/', 'HomeController@index');

// CMS routing
Route::get('cms', 'CmsController@index');
Route::get('cms/users', 'CmsUserController@index');

// Authentication routing
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);