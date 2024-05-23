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

Route::prefix('warranty-extension')->group(function() {
    Route::get('/', 'WarrantyExtensionController@index');
    Route::post('/store', 'WarrantyExtensionController@store');
    Route::post('/product-model', 'WarrantyExtensionController@productModel');
    Route::post('/category-product', 'WarrantyExtensionController@categoryProduct');
});
Route::prefix('admin/warranty-extension')->group(function() {
    Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:warranty_extension', 'uses' => 'AdminWarrantyExtensionController@index']);
		Route::get('/list', ['middleware' => 'permission:warranty_extension', 'uses' => 'AdminWarrantyExtensionController@list']);
		Route::get('/export', ['middleware' => 'permission:warranty_extension', 'uses' => 'AdminWarrantyExtensionController@export']);
		Route::get('/view/{id}', ['middleware' => 'permission:warranty_extension', 'uses' => 'AdminWarrantyExtensionController@show']);
		// Route::post('/update', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@update']);
	});
});

