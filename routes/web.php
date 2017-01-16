<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PagesController@getHome')->name('home');

Route::get('/about', 'PagesController@getAbout');

/* ---------- Contact Routes -------- */

Route::get('/contact', 'PagesController@getContact')->name('contact.index');
Route::post('/contact', 'PagesController@postContact')->name('contact.send');

/* ---------- Blog Routes -------- */

Route::get('blog', 'BlogController@getIndex')->name('blog.index');
Route::get('blog/{slug}', 'BlogController@getPost')->name('blog.post')->where('slug', '[\w\d\-\_]+'); 


/* ------ Authenticaiton Routes ------ */ 

// --- lOGIN
Route::get('login', 'Auth\LoginController@showLoginForm'); 
Route::post('login', 'Auth\LoginController@login');

// --- PASSWORD

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email',  'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// --- LOGOUT

Route::get('logout', 'Auth\LoginController@logout');

// --- REGISTER

Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register');


Route::group(['middleware' => 'auth'], function(){

	Route::resource('posts', 'PostController');
	Route::resource('categories', 'CategoryController', ['except' => 'create']);
	Route::resource('tags', 'TagController', ['except' => ['create', 'index']]);
	
});


/* ------ Comment Routes ------ */

Route::post('comments/{postId}', 'CommentsController@store')->name('comments.store');

Route::delete('comments/{commentId}/delete', 'CommentsController@delete')->name('comments.delete');