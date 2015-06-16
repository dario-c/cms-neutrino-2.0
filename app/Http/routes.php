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

// custom csrf check for ajax
Route::filter('csrf', function()
{
   $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
   if (Session::token() != $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});

// Frontend Routing
Route::get('/', 'HomeController@index');

// CMS routing
Route::get('cms', 'CmsController@index');
// Route::get('cms/users', 'CmsUserController@index');
// Route::get('cms/users/create', 'CmsUserController@create');
// Route::get('cms/users/{id}/edit', 'CmsUserController@edit');
// Route::get('cms/users/{id}/update', 'CmsUserController@update');

Route::resource('cms/users', 'CmsUserController');
Route::resource('cms/text-keys', 'CmsTextKeyController');

// CMS Upload handling
Route::post('cms/upload-handler/', 'CmsUploadController@store');
Route::any('cms/upload-progress/', 'CmsUploadController@progress');

// CMS Partials
Route::get('cms/partials/media/files', 'CmsMediaFilesController@index');

// CMS Post Type routing
Route::get('cms/{post_type}', 'CmsPostTypeController@index');
Route::get('cms/{post_type}/create', 'CmsPostTypeController@create');
Route::post('cms/{post_type}', 'CmsPostTypeController@store');
Route::get('cms/{post_type}/{id}', 'CmsPostTypeController@show');
Route::get('cms/{post_type}/{id}/edit', 'CmsPostTypeController@edit');
Route::patch('cms/{post_type}/{id}', 'CmsPostTypeController@update');
Route::delete('cms/{post_type}/{id}', 'CmsPostTypeController@destroy');

// Image Routing
Route::get('image/{option}/{id}.{extension}', 'ImageController@show');

// Authentication routing
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
