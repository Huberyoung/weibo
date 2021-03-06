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


Route::get("/","StaticPagesController@home")->name('home');
Route::get("/help","StaticPagesController@help")->name('help');
Route::get("/about","StaticPagesController@about")->name('about');

Route::get('signup','UsersController@create')->name('signup');

Route::resource('users','UsersController');

Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');

Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');


Route::prefix('password')->name('password.')->group(function () {
    Route::get('reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
    Route::post('email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
    Route::get('reset/{token}','Auth\ResetPasswordController@showResetForm')->name('reset');
    Route::post('reset','Auth\ResetPasswordController@reset')->name('update');
});

Route::resource('statuses', 'StatusesController',['only' => ['store', 'destroy']]);

Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
