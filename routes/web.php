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

Route::group(['prefix'=>'management'],function(){
    Route::get('login', 'Admin\AuthAdmin\LoginController@showLoginForm')->name('admin-login');
    Route::post('login', 'Admin\AuthAdmin\LoginController@login')->name('do-admin-login');
    Route::get('logout', 'Admin\AuthAdmin\LoginController@logout')->name('do-admin-logout');

    Route::group(['middleware'=>['auth:admin'/*,'init_admin_common_data'*/]],function(){
        ///Route::group(['middleware'=>['route_permission']],function(){
            Route::get('/', function(){
                return redirect('admin/dashboard');
            });
            Route::get('dashboard', 'Admin\AdminController@dashboard');

            Route::get('/user/admin', 'Admin\AdminController@showAdmins')->name('admin-user-list');
            Route::get('/user/admin/add', 'Admin\AdminController@showAddAdminForm')->name('add_admin_form');
            Route::post('/user/admin/add', 'Admin\AdminController@saveAdmin')->name('do_add_admin');
            Route::post('/user/admin/delete', 'Admin\AdminController@deleteAdmin')->name('delete_admin_user');
            Route::get('/user/admin/edit/{id}', 'Admin\AdminController@editAdmin')->name('edit_admin_form');
            Route::post('/user/admin/edit', 'Admin\AdminController@doEditAdmin')->name('do_edit_admin');

            Route::get('/user/admin/edit_sec_permit/{id}', 'Admin\AdminController@editSectionPermit');
            Route::post('/user/admin/edit_sec_permit', 'Admin\AdminController@doEditSectionPermit');



        //});
    });


});
