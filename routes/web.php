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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/', 'PostController@index')->name('posts');

Route::get('/demo', function(){
    return view('demo/index');
});


Auth::routes();
Route::get('/admin', 'HomeController@index')->name('admin');

/* Posts */
Route::get('admin/posts/create', 'PostController@create')->name('createPost');
Route::post('admin/posts', 'PostController@store')->name('storePost');
Route::get('/posts/{slug}', 'PostController@show')->name('showPost');
Route::get('/{slug}', 'PostController@show')->name('showPost');
Route::get('/admin/post/edit/{id}','PostController@edit')->name('editPost');
Route::post('/admin/posts/{id}', 'PostController@update')->name('updatePost');
Route::get('/admin/posts/delete/{id}', 'PostController@destroy')->name('destroyPost');



/*Tags */
Route::post('admin/tags', 'TagController@store')->name('storeTag');
Route::get('admin/tags', 'TagController@index')->name('tags');