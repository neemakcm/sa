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

Route::group(['prefix' => '/admin/stores'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@index']);
		Route::get('/list', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@delete']);
		Route::get('/add', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@add']);
		Route::post('/store', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@edit']);
		Route::post('/update', ['middleware' => 'permission:stores', 'uses' => 'AdminStoresController@update']);
	});
});


Route::group(['prefix' => '/stores'], function()
{
	Route::get('/', ['uses' => 'StoresController@index']);
	Route::get('/state-district', ['uses' => 'StoresController@getStateDistricts']);
	Route::get('/map-content', ['uses' => 'StoresController@mapContent']);
	Route::get('/district-drop', ['uses' => 'StoresController@districtStore']);
	
});


