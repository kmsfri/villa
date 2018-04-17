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

//Website routes

//villa

Route::group(['middleware'=>['saveVisitor']],function() {
    Route::get('villa/{slug}', 'users\web\VillaController@showSingleVilla')
        ->middleware('saveVillaVisitor')
        ->name('showvilla');
    Route::get('villas', 'users\web\VillaController@showallvillas')->name('showvillas');
    Route::post('villas', 'users\web\VillaController@savewebsitecomment')->name('savewebsitecomment');
    Route::post('villa/{id}/Comment', 'users\web\VillaController@villa_comment')->name('villa_comment');

    Route::get('user/{slug}', 'users\web\VillaController@userpage')->name('userpage');
    Route::get('search', 'users\web\VillaController@search')->name('search');

    //Reserve Request

    Route::post('villa/{id}/Reserve', 'users\web\VillaController@reserve_request')->name('reserve_request');

    //Villa Search
});

//NewsLetter Register
Route::post('NewsLetter','users\web\WebsiteGeneralController@newsletter_register')->name('newsletter_register');

//Content_Report
Route::post('Content/Report/{id}','users\web\WebsiteGeneralController@content_report')->name('content_report');
//Villa_Report
Route::post('Villa/Report/{id}','users\web\WebsiteGeneralController@villa_report')->name('villa_report');

//Villa Rating
Route::post('Villa/Rate/{id}','users\web\WebsiteGeneralController@rate_villa')->name('rate_villa');
Route::post('VillaRate','users\web\WebsiteGeneralController@rate_villa_list')->name('rate_villa_list');
//Content Rating
Route::post('Content/Rate/{id}','users\web\WebsiteGeneralController@rate_content')->name('rate_content');



//blog
Route::get('گردشگری/استان/{province_slug}','users\web\BlogController@websiteArticles')->name('provinceArticles');
Route::get('گردشگری/دسته/{category_slug}','users\web\BlogController@websiteArticles')->name('categoryArticles');
Route::get('گردشگری/','users\web\BlogController@websiteArticles')->name('websiteArticles');
Route::get('گردشگری/{slug}','users\web\BlogController@showArticle')
    ->middleware('saveContentVisitor')
    ->name('showArticle');
Route::post('Article/{id}/Comment','users\web\BlogController@content_comment')->name('content_comment');

Route::post('/ajax/get_province_cities', 'API\AjaxServicesController@get_province_cities');
//User Auth Routes
Route::get('User/Login', 'users\auth\AuthController@showUserLoginForm')->name('showlogin');
Route::post('User/Login', 'users\auth\AuthController@Login')->name('login');
Route::get('User/Register', 'users\auth\AuthController@showUserRegisterForm')->name('showregister');
Route::post('User/Register', 'users\auth\AuthController@Register')->name('register');
Route::get('User/Password', 'users\auth\AuthController@showUserNewPasswordForm')->name('showpassword');
Route::post('User/Password', 'users\auth\AuthController@NewPassword')->name('password');
Route::get('User/Logout', 'users\auth\AuthController@logout')->name('logout');

//User Dashboard
Route::group(['prefix' => 'User',  'middleware' => ['auth:user', 'getSectionPathParts']], function(){
    Route::get('Dashboard','users\GeneralController@showDashboard')->name('showdashboard');
    Route::get('Edit','users\UserController@showUser')->name('showuser');
    Route::post('Edit','users\UserController@useraction')->name('useraction');

    Route::group(['middleware' => 'renterProfileCompletionCheck'], function() {
        Route::get('Blog', 'users\GeneralController@showBlogconfig')->name('showblog');
        Route::post('Blog', 'users\GeneralController@blogaction')->name('blogaction');
        Route::get('Content', 'users\ContentController@addcontent')->name('addcontent');
        Route::get('Content/{id}', 'users\ContentController@editcontent')->name('editcontent');
        Route::post('Content', 'users\ContentController@addcontentaction')->name('addcontentaction');
        Route::get('Content/category/{content_id}', 'users\ContentController@editContentCategory')->name('editContentCategory');
        Route::post('Content/category', 'users\ContentController@doEditContentCategory')->name('doEditContentCategory');
        Route::get('Contents', 'users\ContentController@contents')->name('contents');
        Route::get('Content/showinbody/{id}', 'users\ContentController@showinbody')->name('showinbody');
        Route::get('Content/draft/{id}', 'users\ContentController@draft')->name('draft');


        Route::get('Villa', 'users\VillaController@addVilla')->name('addVillaForm');
        Route::get('Villa/{id}', 'users\VillaController@editVilla')->name('editVillaForm');
        Route::post('Villa', 'users\VillaController@doSaveVilla')->name('doSaveVilla');
        Route::get('Villa/category/{villa_id}', 'users\VillaController@editVillaCategory')->name('editVillaCategory');
        Route::post('Villa/category', 'users\VillaController@doEditVillaCategory')->name('doEditVillaCategory');
        Route::get('Villas', 'users\VillaController@showVillaList')->name('villaList');


        Route::get('tickets', 'users\TicketController@showTicketList')->name('ticketList');
        Route::post('ticket/save', 'users\TicketController@doSaveTicket')->name('doSaveTicket');
        Route::get('ticket/messages/{ticket_id?}', 'users\TicketController@showTicketMessages')->name('ticketMessages');
        Route::get('ticket/message', 'users\TicketController@doAddTicketMessage')->name('doAddTicketMessage');


    });
});

Route::group(['prefix'=>'management'],function(){
    Route::get('login', 'Admin\AuthAdmin\LoginController@showLoginForm')->name('admin-login');
    Route::post('login', 'Admin\AuthAdmin\LoginController@login')->name('do-admin-login');
    Route::get('logout', 'Admin\AuthAdmin\LoginController@logout')->name('do-admin-logout');

    Route::group(['middleware'=>['auth:admin'/*,'init_admin_common_data'*/]],function(){
        Route::group(['middleware'=>[/*'route_permission'*/]],function(){
            Route::get('/', function(){
                return redirect(Route('dashboard'));
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

            Route::get('contents','Admin\ContentController@showContentList')->name('adminShowContentList');
            Route::get('content','Admin\ContentController@addContent')->name('adminAddContentForm');
            Route::get('content/{id}','Admin\ContentController@editContent')->name('adminEditContentForm');
            Route::post('content','Admin\ContentController@doSaveContent')->name('adminDoSaveContent');
            Route::post('content/remove','Admin\ContentController@doRemoveContent')->name('adminRemoveContent');
            Route::get('content/category/{content_id}','Admin\ContentController@editContentCategory')->name('adminEditContentCategory');
            Route::post('content/category','Admin\ContentController@doEditContentCategory')->name('adminDoEditContentCategory');
            Route::get('content/showinblog/{id}','Admin\ContentController@showInBlog')->name('adminShowinBlog');

            Route::get('/category2/add/{parent_id?}', 'Admin\Category2Controller@showAddCategoryForm')->name('add-category2-form');
            Route::post('/category2/add', 'Admin\Category2Controller@saveCategory')->name('do-add-category2');
            Route::post('/category2/delete/{parent_id?}', 'Admin\Category2Controller@deleteCategory')->name('do-delete-category2');
            Route::get('/category2/edit/{id}', 'Admin\Category2Controller@editCategory')->name('edit-category2-form');
            Route::post('/category2/edit', 'Admin\Category2Controller@doEditCategory')->name('do-edit-category2');
            Route::get('/category2/{parent_id?}', 'Admin\Category2Controller@categories')->name('categories2-list');

            Route::get('/category1/add/{parent_id?}', 'Admin\Category1Controller@showAddCategoryForm')->name('add-category1-form');
            Route::post('/category1/add', 'Admin\Category1Controller@saveCategory')->name('do-add-category1');
            Route::post('/category1/delete/{parent_id?}', 'Admin\Category1Controller@deleteCategory')->name('do-delete-category1');
            Route::get('/category1/edit/{id}', 'Admin\Category1Controller@editCategory')->name('edit-category1-form');
            Route::post('/category1/edit', 'Admin\Category1Controller@doEditCategory')->name('do-edit-category1');
            Route::get('/category1/{parent_id?}', 'Admin\Category1Controller@categories')->name('categories1-list');

            Route::get('/property/add/{parent_id?}', 'Admin\PropertyController@showAddPropertyForm')->name('addPropertyForm');
            Route::post('/property/add', 'Admin\PropertyController@saveProperty')->name('saveProperty');
            Route::post('/property/delete/{parent_id?}', 'Admin\PropertyController@deleteProperty')->name('deleteProperty');
            Route::get('/property/edit/{id}', 'Admin\PropertyController@editProperty')->name('editPropertyForm');
            Route::post('/property/edit', 'Admin\PropertyController@doEditProperty')->name('doEditProperty');
            Route::get('/property/{parent_id?}', 'Admin\PropertyController@properties')->name('propertiesList');

            Route::get('/user/renter', 'Admin\RenterUserController@showRenterUsers')->name('renter-user-list');
            Route::get('/user/renter/add', 'Admin\RenterUserController@showAddRenterUserForm')->name('add_renter_form');
            Route::post('/user/renter/add', 'Admin\RenterUserController@saveRenterUser')->name('do_add_renter');
            Route::post('/user/renter/delete', 'Admin\RenterUserController@deleteRenterUser')->name('delete_renter_user');
            Route::get('/user/renter/edit/{id}', 'Admin\RenterUserController@editRenterUser')->name('edit_renter_form');
            Route::post('/user/renter/edit', 'Admin\RenterUserController@doEditRenterUser')->name('do_edit_renter');



            Route::get('villa/{user_id?}','Admin\VillaController@showVillaList')->name('adminShowVillaList');
            Route::get('villa/add/{renter_user_id}','Admin\VillaController@addVilla')->name('adminAddVillaForm');
            Route::get('villa/edit/{id}','Admin\VillaController@editVilla')->name('adminEditVillaForm');
            Route::post('villa/save','Admin\VillaController@doSaveVilla')->name('adminDoSaveVilla');
            Route::post('villa/remove','Admin\VillaController@doRemoveVilla')->name('adminRemoveVilla');
            Route::get('villa/category/{villa_id}','Admin\VillaController@editVillaCategory')->name('adminEditVillaCategory');
            Route::post('villa/category','Admin\VillaController@doEditVillaCategory')->name('adminDoEditVillaCategory');


            Route::get('/tariff/add', 'Admin\TariffController@showAddTariffForm')->name('addTariffForm');
            Route::post('/tariff/add', 'Admin\TariffController@saveTariff')->name('doAddTariff');
            Route::post('/tariff/delete', 'Admin\TariffController@deleteTariff')->name('doDeleteTariff');
            Route::get('/tariff/edit/{id}', 'Admin\TariffController@editTariff')->name('editTariff');
            Route::post('/tariff/edit', 'Admin\TariffController@doEditTariff')->name('doEditTariff');
            Route::get('/tariffs', 'Admin\TariffController@Tariffs')->name('adminTariffList');


            Route::get('/villaType/add', 'Admin\VillaController@showAddVillaTypeForm')->name('addVillaTypeForm');
            Route::post('/villaType/add', 'Admin\VillaController@saveVillaType')->name('doAddVillaType');
            Route::post('/villaType/delete', 'Admin\VillaController@deleteVillaType')->name('doDeleteVillaType');
            Route::get('/villaType/edit/{id}', 'Admin\VillaController@editVillaType')->name('editVillaType');
            Route::post('/villaType/edit', 'Admin\VillaController@doEditVillaType')->name('doEditVillaType');
            Route::get('/villaTypes', 'Admin\VillaController@villaTypes')->name('adminVillaTypeList');



            Route::get('tickets/{renter_user_id?}', 'Admin\TicketController@showTicketList')->name('adminTicketList');
            Route::post('ticket/save', 'Admin\TicketController@doSaveTicket')->name('adminDoSaveTicket');
            Route::post('ticket/delete', 'Admin\TicketController@deleteTicket')->name('adminDeleteTicket');
            Route::get('ticket/messages/{ticket_id?}', 'Admin\TicketController@showTicketMessages')->name('adminTicketMessages');



            Route::post('/reports/delete', 'Admin\ReportController@deleteReport')->name('doDeleteReport');
            Route::get('/reports/edit/{id}', 'Admin\ReportController@editReport')->name('editReport');
            Route::post('/reports/edit', 'Admin\ReportController@doEditReport')->name('doEditReport');
            Route::get('/reports/{villa_id?}', 'Admin\ReportController@Reports')->name('adminReportList');

            Route::post('/commant/villa/delete', 'Admin\VillaController@deleteComment')->name('doDeleteVillaComment');
            Route::get('/commant/villa/edit/{id}', 'Admin\VillaController@editComment')->name('editVillaComment');
            Route::post('/commant/villa/edit', 'Admin\VillaController@doEditComment')->name('doEditVillaComment');
            Route::get('/commant/villa/{villa_id?}', 'Admin\VillaController@Comments')->name('adminVillaCommentList');


            Route::post('/commant/content/delete', 'Admin\ContentController@deleteComment')->name('doDeleteContentComment');
            Route::get('/commant/content/edit/{id}', 'Admin\ContentController@editComment')->name('editContentComment');
            Route::post('/commant/content/edit', 'Admin\ContentController@doEditComment')->name('doEditContentComment');
            Route::get('/commant/content/{content_id?}', 'Admin\ContentController@Comments')->name('adminContentCommentList');

            Route::post('/commant/website/delete', 'Admin\WebsiteController@deleteComment')->name('doDeleteWebsiteComment');
            Route::get('/commant/website/edit/{id}', 'Admin\WebsiteController@editComment')->name('editWebsiteComment');
            Route::post('/commant/website/edit', 'Admin\WebsiteController@doEditComment')->name('doEditWebsiteComment');
            Route::get('/commant/website', 'Admin\WebsiteController@Comments')->name('adminWebsiteCommentList');





        });
    });
});