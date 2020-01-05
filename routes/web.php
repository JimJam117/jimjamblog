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
    return redirect('/posts');
});

Auth::routes();

// Search
Route::post('/search', 'SearchController@fetch');
Route::get('/search/{search}', 'SearchController@show')->name('search');

// Post
Route::get('/post/create', 'PostController@create')->middleware('auth');
Route::get('/posts', 'PostController@index');
Route::post('/post', 'PostController@store')->middleware('auth');
Route::get('/post/{post}', 'PostController@show');
Route::get('/post/', 'PostController@index');

// Category
Route::get('/category/create', 'CategoryController@create')->middleware('auth');
Route::get('/categories', 'CategoryController@index');
Route::post('/category', 'CategoryController@store')->middleware('auth');
Route::get('/category/{category}', 'CategoryController@show');
Route::get('/category/', 'CategoryController@index');

Route::get('/backend', 'BackendController@index')->name('backend');
Route::get('/home', 'HomeController@index')->name('home');
