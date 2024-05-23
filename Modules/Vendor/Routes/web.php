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


Route::group(['prefix' => '/admin/vendor'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@index']);
		Route::get('/list', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@delete']);
		Route::get('/add', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@add']);
		Route::post('/store', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@edit']);
		Route::post('/update/{id}', ['middleware' => 'permission:vendor', 'uses' => 'AdminVendorController@update']);
	});
});
Route::prefix('vendors')->group(function() {
    Route::get('/', 'VendorController@index');
});