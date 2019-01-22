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
Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['namespace' => 'Me', 'prefix' => 'me'], function ($api) {
        //Profile
        $api->get('/', 'UserController@getMe');
        $api->post('change-password', 'UserController@changePassword');
    });
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($api) {
        Route::group(['middleware' => 'admin'],function($api){
        $api->resource('records', 'RecordController');
        $api->post('search','RecordController@search');
        $api->resource('incident', 'IncidentController');
        $api->resource('province', 'ProvinceController');
        $api->post('register', 'UserController@register');
        $api->get('users', 'UserController@getUsers');

        });
    });

    Route::post('details', 'UserController@details');
});
/*Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});*/
