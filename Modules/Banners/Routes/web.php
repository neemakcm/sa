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

Route::group(['prefix' => '/admin/banners'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@index']);
		Route::get('/list', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@delete']);
		Route::get('/add', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@add']);
		Route::post('/store', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@store']);
		Route::get('/delete/{id}', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@delete']);
		Route::get('/edit/{id}', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@edit']);
		Route::post('/update', ['middleware' => 'permission:banners', 'uses' => 'AdminBannersController@update']);
	});
});
Route::group(['prefix' => '/admin/about/banners'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'BannerAboutController@index']);
		Route::get('/list', ['uses' => 'BannerAboutController@list']);
		Route::get('/delete/{id}', ['uses' => 'BannerAboutController@delete']);
		Route::get('/add', ['uses' => 'BannerAboutController@add']);
		Route::post('/store', ['uses' => 'BannerAboutController@store']);
		Route::get('/delete/{id}', ['uses' => 'BannerAboutController@delete']);
		Route::get('/edit/{id}', ['uses' => 'BannerAboutController@edit']);
		Route::post('/update', ['uses' => 'BannerAboutController@update']);
	});
});