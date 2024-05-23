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

Route::group(['prefix' => 'admin'], function()
{
    
    Route::get('login', 'LoginController@showLoginForm')->name('login');
	Route::post('login ', 'LoginController@login');
	Route::get('logout', 'LoginController@logout')->name('admin.logout');


	Route::get('forbidden', 'AdminController@forbidden');


	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminController@dashboard']);
		Route::get('/dashboard', [ 'uses' => 'AdminController@dashboard']);	
	});
	Route::get('page-cache',  [ 'uses' => 'AdminController@cachClear'],function () {
		Artisan::call('page-cache:clear');
	
		// return 'Page Cache cleared.';
	});
	
});


Route::group(['prefix' => '/admin/admin-users'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@index']);
		Route::get('/list', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@delete']);
		Route::get('/add', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@add']);
		Route::post('/store', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@edit']);
		Route::post('/update', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@update']);
		Route::get('/view/{id}', ['middleware' => 'permission:admin_users', 'uses' => 'AdminUserController@view']);
	});
});