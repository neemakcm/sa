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


Route::group(['prefix' => '/admin/drop-point'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@index']);
		Route::get('/list', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@delete']);
		Route::get('/add', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@add']);
		Route::post('/store', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@edit']);
		Route::post('/update', ['middleware' => 'permission:stores', 'uses' => 'AdminDropPointController@update']);
	});
});


Route::group(['prefix' => '/drop-point'], function()
{
	Route::get('/', ['uses' => 'DropPointController@index']);
	Route::get('/getStateDistricts/{id}', ['uses' => 'DropPointController@getStateDistricts']);
	Route::get('/map-content', ['uses' => 'DropPointController@mapContent']);
	Route::get('/district-drop', ['uses' => 'DropPointController@districtDrop']);

});


