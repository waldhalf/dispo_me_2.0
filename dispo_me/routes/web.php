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

Route::get('/', function () {
    return view('welcome2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/disclaimer', function() {
    return view('disclaimer');
});
/* CRUD pour les posts*/
// Route::resource('posts', 'PostController')->middleware('is_admin');
Route::get('/posts', 'PostController@index')->middleware('is_admin');
Route::get('/posts/create', 'PostController@create')->middleware('is_admin');
Route::post('/posts/create', 'PostController@store')->middleware('is_admin');


Route::get('/admin', 'AdminController@admin')->middleware('is_admin');