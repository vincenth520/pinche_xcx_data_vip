<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {
        $api->post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
        $api->post('/login', 'App\Http\Controllers\Auth\LoginController@login');
        $api->post('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
        $api->post('/token/refresh', 'App\Http\Controllers\Auth\LoginController@refresh');
        $api->post('upload', 'App\Http\Controllers\UploadController@index');
        $api->get('/total', 'App\Http\Controllers\Admin\TotalController@index');

        $api->group(['middleware' => 'auth:api'], function ($api) {
            $api->get('/user', function (Request $request) {
                return $request->user();
            });
            $api->post('/change_password', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
            $api->get('/setting', 'App\Http\Controllers\Admin\SettingController@index');
            $api->post('/set_setting', 'App\Http\Controllers\Admin\SettingController@setSetting');
            $api->get('/customer', 'App\Http\Controllers\Admin\CustomerController@index');

            $api->put('set_status/{id}', 'App\Http\Controllers\Admin\CustomerController@setStatus');
            $api->get('/authentication_driver', 'App\Http\Controllers\Admin\CustomerController@getAuthenticationDriver');
            $api->get('/driver', 'App\Http\Controllers\Admin\DriverController@getDriver');
            $api->get('/driver/change_status', 'App\Http\Controllers\Admin\CustomerController@changeDriverStatus');
            $api->resource('/banner', 'App\Http\Controllers\Admin\BannerController');
            $api->resource('/article', 'App\Http\Controllers\Admin\ArticlesController');
            $api->resource('/info', 'App\Http\Controllers\Admin\InfoController');
        });
    });

    $api->post('customer/login', 'App\Http\Controllers\CustomerController@login');

    $api->post('banner', 'App\Http\Controllers\BannersController@index');
    $api->group(['middleware' => 'sk'], function ($api) {
        $api->get('/article/{id}', 'App\Http\Controllers\Admin\ArticlesController@show');

        $api->post('appointment/add', 'App\Http\Controllers\AppointmentsController@store');
        $api->post('appointment/mycount', 'App\Http\Controllers\AppointmentsController@getMyAppointmentCount');
        $api->post('appointment/my', 'App\Http\Controllers\AppointmentsController@getMyInfoAppointment');
        $api->post('appointment/getPassenger', 'App\Http\Controllers\AppointmentsController@getMyAppointment');
        $api->post('appointment/detail', 'App\Http\Controllers\AppointmentsController@getAppointmentDetail');        
        $api->post('appointment/submit', 'App\Http\Controllers\AppointmentsController@agreeAppointment');

        $api->post('msg/getall', 'App\Http\Controllers\MessagesController@getAllTypeList');
        $api->post('msg/get', 'App\Http\Controllers\MessagesController@getListByType');
        $api->post('customer', 'App\Http\Controllers\CustomerController@getMyInfo');
        $api->post('customer/vaild_sk', 'App\Http\Controllers\CustomerController@vaild_sk');
        $api->post('customer/editUser', 'App\Http\Controllers\CustomerController@editUser');
        $api->post('upload', 'App\Http\Controllers\UploadController@index');
        $api->post('info/mycount', 'App\Http\Controllers\InfoController@getMyCount');
        $api->post('info/mylist', 'App\Http\Controllers\InfoController@getMyList');
        $api->post('info/del', 'App\Http\Controllers\InfoController@deleteInfo');
        $api->post('info/lists', 'App\Http\Controllers\InfoController@getlists');
        $api->post('info/add', 'App\Http\Controllers\InfoController@addInfo');
        $api->post('info/index', 'App\Http\Controllers\InfoController@getInfo');
        $api->post('getcode', 'App\Http\Controllers\ValidateController@getCode');
        $api->post('fav/isfav', 'App\Http\Controllers\CollectsController@isCollect');
        $api->post('fav/addfav', 'App\Http\Controllers\CollectsController@addCollect');
        $api->post('fav/delfav', 'App\Http\Controllers\CollectsController@deleteCollect');
        $api->post('fav/myFav', 'App\Http\Controllers\CollectsController@getMyCollect');

        $api->post('comment/get_count', 'App\Http\Controllers\CommentController@getCommentCount');
        $api->post('comment/add', 'App\Http\Controllers\CommentController@addComment');
        $api->post('comment/get', 'App\Http\Controllers\CommentController@getCommentList');
        $api->post('comment/zan', 'App\Http\Controllers\CommentController@zan');

        $api->post('dynamic/add', 'App\Http\Controllers\MomentController@addMoment');
        $api->post('dynamic/getlist', 'App\Http\Controllers\MomentController@getMomentsList');
        $api->post('dynamic/del', 'App\Http\Controllers\MomentController@deleteMoment');

        $api->post('driver/authentication', 'App\Http\Controllers\DriverController@authentication');
        $api->get('driver/get_authentication', 'App\Http\Controllers\DriverController@getAuthentication');
    });
});
//
//Route::prefix('admin')->group(function () {
//
//    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
//    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
//
//    Route::middleware('auth:api')->group(function () {
//
//        Route::get('/user', function (Request $request) {
//            return $request->user();
//        });
//        Route::post('/change_password', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
//        Route::get('/setting', 'App\Http\Controllers\Admin\SettingController@index');
//        Route::post('/set_setting', 'App\Http\Controllers\Admin\SettingController@setSetting');
//        Route::get('/customer', 'App\Http\Controllers\Admin\CustomerController@index');
//    });
//
//});
//
//
//Route::post('customer/login', 'App\Http\Controllers\CustomerController@login');
//
//Route::middleware('sk')->group(function () {
//    Route::post('customer/vaild_sk', 'App\Http\Controllers\CustomerController@vaild_sk');
//    Route::post('customer/editUser', 'App\Http\Controllers\CustomerController@editUser');
//    Route::post('upload', 'App\Http\Controllers\UploadController@index');
//    Route::post('info/mycount', 'App\Http\Controllers\InfoController@getMyCount');
//    Route::post('info/mylist', 'App\Http\Controllers\InfoController@getMyList');
//    Route::post('info/del', 'App\Http\Controllers\InfoController@deleteInfo');
//    Route::post('info/lists', 'App\Http\Controllers\InfoController@getlists');
//    Route::post('info/add', 'App\Http\Controllers\InfoController@addInfo');
//    Route::post('info/index', 'App\Http\Controllers\InfoController@getInfo');
//    Route::post('getcode', 'App\Http\Controllers\ValidateController@getCode');
//    Route::post('fav/isfav', 'App\Http\Controllers\CollectsController@isCollect');
//    Route::post('fav/addfav', 'App\Http\Controllers\CollectsController@addCollect');
//    Route::post('fav/delfav', 'App\Http\Controllers\CollectsController@deleteCollect');
//    Route::post('fav/myFav', 'App\Http\Controllers\CollectsController@getMyCollect');
//
//    Route::post('comment/get_count', 'App\Http\Controllers\CommentController@getCommentCount');
//    Route::post('comment/add', 'App\Http\Controllers\CommentController@addComment');
//    Route::post('comment/get', 'App\Http\Controllers\CommentController@getCommentList');
//    Route::post('comment/zan', 'App\Http\Controllers\CommentController@zan');
//
//    Route::post('dynamic/add', 'App\Http\Controllers\MomentController@addMoment');
//    Route::post('dynamic/getlist', 'App\Http\Controllers\MomentController@getMomentsList');
//    Route::post('dynamic/del', 'App\Http\Controllers\MomentController@deleteMoment');
//
//    Route::post('driver/authentication', 'App\Http\Controllers\DriverController@authentication');
//    Route::get('driver/get_authentication', 'App\Http\Controllers\DriverController@getAuthentication');
//});
