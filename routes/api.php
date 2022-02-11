<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/home', 'Api\HomeController@index');
Route::get('/portfolio', 'Api\PortfolioController@index');

Route::get('/posts_all', 'Api\PostController@posts_all');
Route::get('/posts', 'Api\PostController@index');

Route::get('/post/{post}', 'Api\PostController@show');


Route::get('/categories_all', 'Api\CategoryController@categories_all');
Route::get('/categories', 'Api\CategoryController@index');

Route::get('/category/{category}', 'Api\CategoryController@show');

Route::get('/search/{search}', 'Api\SearchController@show');

Route::post('/contact', 'ContactController@send');
Route::get('/email', function() {
    return view('email');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

