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

Route::group(['prefix' => '/admin/roles'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@index']);
		Route::get('/list', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@list']);
		//Route::get('/delete/{id}', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@delete']);
		Route::get('/add', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@add']);
		Route::post('/store', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@edit']);
		Route::post('/update', ['middleware' => 'permission:roles', 'uses' => 'AdminRolesController@update']);
	});
});