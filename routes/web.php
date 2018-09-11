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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth:api'],function(){
    Route::group(['middleware'=> 'private.files','namespace' => 'Admin'],function($api){
        $api->get('file/{folder}/{file}','FileController@getFile');
        $api->get('file/{folder}/{file}/download','FileController@downloadFile');
    });

});