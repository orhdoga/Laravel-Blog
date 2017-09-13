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
    return view('welcome');
});

Auth::routes();

Route::get('/threads', 'ThreadController@index');
Route::get('/threads/{tag}', 'ThreadController@sortByTag');
Route::get('/threads/{tag}/{thread}', 'ThreadController@show');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/threads/{tag}/{thread}', 'ThreadController@postComment');
    Route::delete('/threads/{tag}/{thread}/{comment}', 'ThreadController@deleteComment');
    Route::get('/threads/{tag}/{thread}/{comment}/edit', 'ThreadController@editComment');
    Route::patch('/threads/{tag}/{thread}/{comment}', 'ThreadController@updateComment');
});
