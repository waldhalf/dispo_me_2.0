<?php
use App\SkillTagModel;
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
Route::post('/', 'PublicPostController@sendContact')->name('send.contact');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/* Test */
Route::get('/test', function() {
    $tags = SkillTagModel::all();
    return view('select2')->withTags($tags);
});

/* Public miscellaneous*/
Route::get('/disclaimer', function() { return view('disclaimer'); });
Route::get('/manual', function() { return view('manual'); });
Route::get('/contact', function() { return view('contact'); });

/* Public posts*/
Route::get('public/posts', 'PublicPostController@index')->name('public.posts');
Route::get('public/posts/{slug}', 'PublicPostController@show')->name('post.show');

/* Public comments */
Route::post('/comments/{id}', 'CommentsController@store')->name('comments.store');
Route::get('/comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
Route::put('/comments/{id}/edit', 'CommentsController@update')->name('comments.update');
Route::get('/comments/{id}/delete', 'CommentsController@destroy')->name('comments.delete');


/* CRUD pour les posts ADMIN*/
Route::get('/posts', 'PostController@index')->name('posts.index');
Route::get('/posts/create', 'PostController@create');
Route::post('/posts/create', 'PostController@store');
Route::get('/posts/{id}/show', 'PostController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'PostController@edit');
Route::post('/posts/{id}/edit', 'PostController@update')->name('post.update');
Route::get('/posts/{id}/delete', 'PostController@destroy');

/* CRUD pour les categorie ADMIN */
Route::get('/categories/index', 'CategoryController@index')->name('categories.index');
Route::post('/categories/index', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{id}/delete', 'CategoryController@destroy')->name('categories.delete');

/* Complétion du profil */
Route::get('/profile_step_1', 'UserProfileController@getStep1')->name('profile.getStep1');
Route::post('/profile_step_1', 'UserProfileController@storeStep1');
Route::get('/profile/{slug}', 'UserProfileController@getProfile')->name('profile.index');
Route::get('/profile/{id}/edit', 'UserProfileController@edit')->name('profile.edit');
Route::post('/profile/{id}/edit', 'UserProfileController@update')->name('profile.update');
Route::get('/profile/{id}/delete', 'UserProfileController@destroy')->name('profile.destroy');

/* CRUD pour les skill_tags ADMIN */
Route::get('/tags/create', 'TagController@create')->name('tags.index');
Route::post('/tags/create', 'TagController@store')->name('tags.store');
Route::get('/tags/{id}/edit', 'TagController@edit')->name('tags.edit');
Route::put('/tags/{id}/edit', 'TagController@update')->name('tags.update');
Route::delete('/tags/{id}/delete', 'TagController@destroy')->name('tags.delete');


Route::get('/admin', 'AdminController@admin')->middleware('is_admin');