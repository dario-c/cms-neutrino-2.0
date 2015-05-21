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

// CMS Post Type routing
Route::get('cms/{post_type}', 'CmsPostTypeController@index');
Route::get('cms/{post_type}/create', 'CmsPostTypeController@create');
Route::post('cms/{post_type}', 'CmsPostTypeController@store');
Route::get('cms/{post_type}/{id}', 'CmsPostTypeController@show');
Route::get('cms/{post_type}/{id}/edit', 'CmsPostTypeController@edit');
Route::patch('cms/{post_type}/{id}', 'CmsPostTypeController@update');
Route::delete('cms/{post_type}/{id}', 'CmsPostTypeController@destroy');

// Authentication routing
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
