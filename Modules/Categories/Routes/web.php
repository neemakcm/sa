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

Route::group(['prefix' => '/admin/categories'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@index']);
		Route::get('/list', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@delete']);
		Route::get('/add', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@add']);
		Route::post('/store', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@edit']);
		Route::post('/update', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@update']);


		Route::get('/attributes/{id}', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@attributesIndex']);
		Route::get('/attributesList', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@attributesList']);
		Route::get('/attributes/delete/{id}', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@attributesDelete']);
		Route::get('/attributes/add/{id}', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@attributesAdd']);
		Route::post('/attributes/store', ['middleware' => 'permission:categories', 'uses' => 'AdminCategoriesController@attributesStore']);
	});
});
