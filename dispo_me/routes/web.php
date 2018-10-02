<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Page principale
Route::get('/', 'PublicPostController@welcome')->name('welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/* Public miscellaneous*/
Route::get('/disclaimer', function() { return view('disclaimer'); });
Route::get('/manual', function() { return view('manual'); });
Route::get('/contact', function() { return view('contact'); });

/* Public posts*/
Route::get('public/posts', 'PublicPostController@index')->name('public.posts');
Route::get('public/posts/{slug}', 'PublicPostController@show');

/* CRUD pour les posts ADMIN*/
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/create', 'PostController@create');
Route::post('/posts/create', 'PostController@store');
Route::get('/posts/{id}/show', 'PostController@show');
Route::get('/posts/{id}/edit', 'PostController@edit');
Route::post('/posts/{id}/edit', 'PostController@update')->name('post.update');
Route::get('/posts/{id}/delete', 'PostController@destroy');

/* CRUD pour les categorie ADMIN */
Route::get('/categories/index', 'CategoryController@index')->name('categories.index');
Route::post('/categories/index', 'CategoryController@store')->name('categories.store');

/* Comlplétion du profil */
Route::get('/profile_step_1', 'UserProfileController@getStep1')->name('profile.getStep1');
Route::post('/profile_step_1', 'UserProfileController@storeStep1');
Route::get('/profile/{slug}', 'UserProfileController@getProfile');

Route::get('/admin', 'AdminController@admin')->middleware('is_admin');