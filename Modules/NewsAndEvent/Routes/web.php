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
Route::group(['prefix' => '/admin/news-and-events'], function()
{
    Route::group(['middleware' => 'admin_auth:admin'], function(){
        Route::get('/', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@index']);
        Route::get('/list', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@list']);
        Route::get('/add', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@add']);
        Route::post('/store', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@store']);
        Route::get('/delete/{id}', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@delete']);
        Route::get('/edit/{id}', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@edit']);
        Route::post('/update', ['middleware' => 'permission:news_and_events', 'uses' => 'AdminNewsAndEventController@update']);
    });
});
Route::prefix('newsandevent')->group(function() {
    Route::get('/', 'NewsAndEventController@index');
});
