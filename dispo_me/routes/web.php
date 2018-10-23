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

/* Public profile follow */
Route::get('/profile/followed', 'UserProfileController@getFollowedProfile')->name('profile.followed');
Route::get('/profile/search/', 'UserProfileController@searchForm')->name('profile.form');
Route::post('/profile/search/', 'UserProfileController@searchProfile')->name('profile.search');
Route::get('/profile/add_followed/{id_followed}', 'UserProfileController@addFollowed')->name('profile.addFollowed');
Route::get('/profile/remove_followed/{id_followed}', 'UserProfileController@deleteFollowed')->name('profile.deleteFollowed');


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
Route::get('/profile/{slug}', 'UserProfileController@getProfile')->name('profile.index');
Route::get('/profile_step_1', 'UserProfileController@getStep1')->name('profile.getStep1');
Route::post('/profile_step_1', 'UserProfileController@storeStep1');
Route::get('/profile_step_2', 'UserProfileController@getStep2')->name('profile.getStep2');
Route::post('/profile_step_2', 'UserProfileController@storeStep2')->name('profile.storeStep2');
Route::get('/profile/{id}/edit_step_1', 'UserProfileController@editStep1')->name('profile.edit_step_1')->middleware('auth');
Route::post('/profile/{id}/edit_step_1', 'UserProfileController@updateStep1')->name('profile.update_step_1');
Route::get('/profile/{id}/edit_step_2', 'UserProfileController@editStep2')->name('profile.edit_step_2');
Route::post('/profile/{id}/edit_step_2', 'UserProfileController@updateStep2')->name('profile.update_step_2');
Route::get('/profile/{id}/delete', 'UserProfileController@destroy')->name('profile.destroy');

/* CRUD pour les skill_tags ADMIN */
Route::get('/tags/create', 'TagController@create')->name('tags.index');
Route::post('/tags/create', 'TagController@store')->name('tags.store');
Route::get('/tags/{id}/edit', 'TagController@edit')->name('tags.edit');
Route::put('/tags/{id}/edit', 'TagController@update')->name('tags.update');
Route::delete('/tags/{id}/delete', 'TagController@destroy')->name('tags.delete');

/* CRUD pour les partenaires ADMIN */
Route::get('/partners/index', 'PartnerController@index')->name('partners.index');
Route::get('/partners/create', 'PartnerController@create')->name('partners.create');
Route::post('/partners/create', 'PartnerController@store')->name('partners.store');
Route::get('/partners/{id}/edit', 'PartnerController@edit')->name('partners.edit');
Route::post('/partners/{id}/edit', 'PartnerController@update')->name('partners.update');
Route::delete('/partners/{id}/delete', 'PartnerController@destroy')->name('partners.delete');



Route::get('/admin', 'AdminController@admin')->middleware('is_admin');