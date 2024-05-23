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

Route::group(['prefix' => '/admin/offers'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@index']);
		Route::get('/list', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@delete']);
		Route::get('/add', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@add']);
		Route::post('/store', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@edit']);
		Route::post('/update', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@update']);

		Route::get('/interest', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@interest']);
		Route::get('/interestList', ['middleware' => 'permission:offers', 'uses' => 'AdminOffersController@interestList']);
	});
});