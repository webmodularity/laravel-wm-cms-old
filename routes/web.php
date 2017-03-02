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

Auth::routes();
// Social Auth Routes
Route::get('social/{userSocialProvider}', "Auth\LoginController@redirectSocialUser");
Route::get('social/handle/{userSocialProvider}', "Auth\LoginController@loginSocialUser");

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('user-log', 'UserLogController', ['only' => [
        'index', 'show'
    ]]);
});
