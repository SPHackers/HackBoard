<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('home');
    });
});

Route::group(['middleware' => 'api', 'prefix' => 'api/v1'], function() {
    Route::resource('user', 'UserController');
    Route::post('login', 'LoginController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::resource('task', 'TaskController');
    });
});
