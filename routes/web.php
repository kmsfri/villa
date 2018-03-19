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


Route::group(['prefix'=>'management'],function(){
    Route::get('login', 'Admin\AuthAdmin\LoginController@showLoginForm')->name('admin-login');
    Route::post('login', 'Admin\AuthAdmin\LoginController@login')->name('do-admin-login');
    Route::get('logout', 'Admin\AuthAdmin\LoginController@logout')->name('do-admin-logout');

    Route::group(['middleware'=>['auth:admin'/*,'init_admin_common_data'*/]],function(){
        ///Route::group(['middleware'=>['route_permission']],function(){
        Route::get('/', function(){
            return redirect('admin/dashboard');
        });
        Route::get('dashboard', 'Admin\AdminController@dashboard')->name('dashboard');

        Route::get('/user/admin', 'Admin\AdminController@showAdmins')->name('admin-user-list');
        Route::get('/user/admin/add', 'Admin\AdminController@showAddAdminForm')->name('add_admin_form');
        Route::post('/user/admin/add', 'Admin\AdminController@saveAdmin')->name('do_add_admin');
        Route::post('/user/admin/delete', 'Admin\AdminController@deleteAdmin')->name('delete_admin_user');
        Route::get('/user/admin/edit/{id}', 'Admin\AdminController@editAdmin')->name('edit_admin_form');
        Route::post('/user/admin/edit', 'Admin\AdminController@doEditAdmin')->name('do_edit_admin');

        Route::get('/user/admin/edit_sec_permit/{id}', 'Admin\AdminController@editSectionPermit')->name('change_admin_sec_permit');
        Route::post('/user/admin/edit_sec_permit', 'Admin\AdminController@doEditSectionPermit')->name('do_change_admin_sec_permit');



        Route::get('/city/add/{parent_id?}', 'Admin\CityController@showAddCityForm')->name('add-city-form');
        Route::post('/city/add', 'Admin\CityController@saveCity')->name('do-add-city');
        Route::post('/city/delete/{parent_id?}', 'Admin\CityController@deleteCity')->name('do-delete-city');
        Route::get('/city/edit/{id}', 'Admin\CityController@editCity')->name('edit-city-form');
        Route::post('/city/edit', 'Admin\CityController@doEditCity')->name('do-edit-city');
        Route::get('/city/{parent_id?}', 'Admin\CityController@cities')->name('cities-list');


        Route::get('/category3/add/{parent_id?}', 'Admin\Category3Controller@showAddCategoryForm')->name('add-category3-form');
        Route::post('/category3/add', 'Admin\Category3Controller@saveCategory')->name('do-add-category3');
        Route::post('/category3/delete/{parent_id?}', 'Admin\Category3Controller@deleteCategory')->name('do-delete-category3');
        Route::get('/category3/edit/{id}', 'Admin\Category3Controller@editCategory')->name('edit-category3-form');
        Route::post('/category3/edit', 'Admin\Category3Controller@doEditCategory')->name('do-edit-category3');
        Route::get('/category3/{parent_id?}', 'Admin\Category3Controller@categories')->name('categories3-list');


        //});
    });


});

