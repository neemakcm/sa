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

Route::group(['prefix' => '/admin/latestVideos'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@index']);
		Route::get('/list', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@delete']);
		Route::get('/add', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@add']);
		Route::post('/store', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@edit']);
		Route::post('/update', ['middleware' => 'permission:latest-videos', 'uses' => 'AdminLatestVideosController@update']);
	});
});
