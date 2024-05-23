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

Route::group(['prefix' => '/admin/support-options'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@index']);
		Route::get('/list', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@delete']);
		Route::get('/add', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@add']);
		Route::post('/store', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@edit']);
		Route::post('/update', ['middleware' => 'permission:support', 'uses' => 'AdminSupportsController@update']);
	});
});
