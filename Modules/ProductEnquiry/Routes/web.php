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

Route::prefix('product-enquiry')->group(function() {
    Route::get('/', 'ProductEnquiryController@index');
    Route::post('/store', 'ProductEnquiryController@store');
});
Route::prefix('admin/product-enquiry')->group(function() {
    Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:product_enquiry', 'uses' => 'AdminProductEnquiryController@index']);
		Route::get('/list', ['middleware' => 'permission:product_enquiry', 'uses' => 'AdminProductEnquiryController@list']);
		Route::get('/export', ['middleware' => 'permission:product_enquiry', 'uses' => 'AdminProductEnquiryController@export']);
		Route::get('/view/{id}', ['middleware' => 'permission:product_enquiry', 'uses' => 'AdminProductEnquiryController@show']);
	});
});
