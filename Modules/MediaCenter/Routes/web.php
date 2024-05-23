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

Route::group(['prefix' => '/admin/mediaCenter'], function()
{
    Route::group(['middleware' => 'admin_auth:admin'], function(){
        Route::get('/', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@index']);
        Route::get('/list', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@list']);
        Route::get('/delete/{id}', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@delete']);
        Route::get('/add', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@add']);
        Route::post('/store', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@store']);
        Route::get('/delete/{id}', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@delete']);
        Route::get('/edit/{id}', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@edit']);
        Route::post('/update', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@update']);
    });
});


Route::prefix('mediaCenters')->group(function() {
    Route::get('/', 'MediaCenterController@index');
    Route::post('/getPaginatedMedia', 'MediaCenterController@getPaginatedMedia');
    Route::get('/details/{id}', 'MediaCenterController@details');
});