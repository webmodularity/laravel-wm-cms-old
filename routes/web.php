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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Auth::routes();
    // Social Auth Routes
    Route::get('social/{socialProvider}', "Auth\LoginController@redirectSocialUser");
    Route::get('social/handle/{socialProvider}', "Auth\LoginController@loginSocialUser");
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['namespace' => 'App\Http\Controllers'], function () {
        Route::get('/', 'DashboardController@index');
    });

    Route::group(['namespace' => '\WebModularity\LaravelCms\Http\Controllers'], function () {
        Route::resource('user-log', 'UserLogController', ['only' => [
            'index', 'show'
        ]]);
    });
});
