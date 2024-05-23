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

Route::group(['prefix' => '/admin/attributes'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@index']);
		Route::get('/list', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@delete']);
		Route::get('/add', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@add']);
		Route::post('/store', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@edit']);
		Route::post('/update', ['middleware' => 'permission:attributes', 'uses' => 'AdminAttributesController@update']);
	});
});
