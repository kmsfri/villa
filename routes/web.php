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



//User Auth Routes
Route::get('User/Login', 'users\auth\AuthController@showUserLoginForm')->name('showlogin');
Route::post('User/Login', 'users\auth\AuthController@Login')->name('login');
Route::get('User/Register', 'users\auth\AuthController@showUserRegisterForm')->name('showregister');
Route::post('User/Register', 'users\auth\AuthController@Register')->name('register');
Route::get('User/Password', 'users\auth\AuthController@showUserNewPasswordForm')->name('showpassword');
Route::post('User/Password', 'users\auth\AuthController@NewPassword')->name('password');
Route::get('User/Logout', 'users\auth\AuthController@logout')->name('logout');

//User Dashboard
Route::group(['prefix' => 'User',  'middleware' => 'auth:user'], function(){


    Route::get('Dashboard','users\GeneralController@showDashboard')->name('showdashboard');
    Route::get('Edit','users\UserController@showUser')->name('showuser');
    Route::post('Edit','users\UserController@useraction')->name('useraction');
    Route::get('Blog','users\GeneralController@showBlogconfig')->name('showblog');
    Route::post('Blog','users\GeneralController@blogaction')->name('blogaction');

});
