<?php

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
Route::post('/login', 'UserController@login')->name("login");
Route::post('register', 'UserController@register')->name("register");
Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['namespace' => 'Me', 'prefix' => 'me'], function ($api) {
        //Profile
        $api->get('/', 'UserController@getMe');
        $api->post('change-password', 'UserController@changePassword');
        $api->resource('file','FileController',['only' => ['index']]);
        $api->resource('file_category', 'FileCategoryController',['only' => ['index']]);
        $api->post('file-upload','FileController@uploadFile');
        $api->get('file/{category_id}/category','FileController@getFileByCategory');
    });
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($api) {
        Route::group(['middleware' => 'admin'],function($api){
        //Profile
        $api->resource('file_category', 'FileCategoryController');
        $api->resource('records', 'RecordController');
        $api->post('search','RecordController@search');
        $api->resource('incident', 'IncidentController');
        $api->resource('province', 'ProvinceController');
        $api->resource('file','FileController');
        $api->post('edit-file-upload/{id}','FileController@editFile');
        $api->post('register', 'UserController@register');
        $api->get('users', 'UserController@getUsers');

        });
    });

    Route::post('details', 'UserController@details');
});
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});*/
