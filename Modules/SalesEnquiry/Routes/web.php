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

Route::prefix('business-enquiry')->group(function() {
    Route::get('/', 'SalesEnquiryController@index');
    Route::post('/store', 'SalesEnquiryController@store');

});
Route::prefix('admin/sales-enquiry')->group(function() {
    Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@index']);
		Route::get('/list', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@list']);
		// Route::post('/export', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@export']);
		Route::post('/export', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@salesExport']);
		Route::get('/view/{id}', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@show']);
		Route::post('/listPost', ['middleware' => 'permission:sales_enquiry', 'uses' => 'AdminSalesEnquiryController@list']);
	
	});
});
