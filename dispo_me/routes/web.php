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
Route::get('/', 'PostController@welcome');


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
Route::get('/posts', 'PostController@index')->name('posts.index')->middleware('is_admin');
Route::get('/posts/create', 'PostController@create')->middleware('is_admin');
Route::post('/posts/create', 'PostController@store')->middleware('is_admin');
Route::get('/posts/{id}/show', 'PostController@show')->middleware('is_admin');
Route::get('/posts/{id}/edit', 'PostController@edit')->middleware('is_admin');
Route::post('/posts/{id}/edit', 'PostController@update')->name('post.update')->middleware('is_admin');
Route::get('/posts/{id}/delete', 'PostController@destroy')->middleware('is_admin');


Route::get('/admin', 'AdminController@admin')->middleware('is_admin');