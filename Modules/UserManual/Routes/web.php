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

Route::group(['prefix' => '/admin/user-manuals'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@index']);
		Route::get('/list', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@delete']);
		Route::get('/add', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@add']);
		Route::post('/store', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@edit']);
		Route::post('/update', ['middleware' => 'permission:user_manual', 'uses' => 'AdminUserManualController@update']);
	});
});
Route::prefix('user-manuals')->group(function() {
    Route::get('/', 'UserManualController@index');
	// Route::get('/get-child-category-list/{id}','UserManualController@index')->name('get.child.category.list');
	Route::post('/get-child-category-list','UserManualController@getChildCategoryList')->name('get.child.category.list');
	Route::post('/get-sub-child-category-list','UserManualController@getSubChildCategoryList')->name('get.sub.child.category.list');
	Route::post('/get-product-list','UserManualController@getProductList')->name('get.product.list');
	Route::post('/get-user-manual-list','UserManualController@getUserManualList')->name('get.user.manual.list');
	Route::post('/get-search-product-list','UserManualController@searchUserManualList')->name('get.search.product.list');
	Route::post('/download-user-manual','UserManualController@download')->name('download.user.manual');
	
});
