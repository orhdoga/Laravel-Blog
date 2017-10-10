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

Route::get('/users/{user}', function (App\User $user) {
	return view('user-details', [
		'user' => $user
	]);
});

Auth::routes();

Route::get('/threads', 'ThreadController@index');
Route::get('/threads/create', 'ThreadController@create');
Route::post('/threads', 'ThreadController@store');
Route::get('/threads/{tag}', 'ThreadController@sortByTag');
Route::get('/threads/{tag}/{thread}', 'ThreadController@show');
Route::get('/threads/{tag}/{thread}/edit', 'ThreadController@edit');
Route::patch('/threads/{tag}/{thread}', 'ThreadController@update');
Route::delete('/threads/{tag}/{thread}', 'ThreadController@destroy');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/threads/{tag}/{thread}', 'ThreadController@postComment');
    Route::delete('/threads/{tag}/{thread}/{comment}', 'ThreadController@deleteComment');
    Route::get('/threads/{tag}/{thread}/{comment}/edit', 'ThreadController@editComment');
    Route::patch('/threads/{tag}/{thread}/{comment}', 'ThreadController@updateComment');
});
