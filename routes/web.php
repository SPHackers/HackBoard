<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('task', 'TaskController');
    Route::resource('user', 'UserController');
    Route::post('login', 'LoginController@login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
