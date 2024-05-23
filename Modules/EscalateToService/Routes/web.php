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

Route::prefix('escalate-to-service')->group(function() {
    Route::get('/', 'EscalateToServiceController@index');
    Route::post('/store', 'EscalateToServiceController@store');
    Route::post('/product-model', 'EscalateToServiceController@productModel');
    Route::post('/category-product', 'EscalateToServiceController@categoryProduct');
});
Route::prefix('admin/escalate-to-service')->group(function() {
    Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:escalate_to_service', 'uses' => 'AdminEscalateToServiceController@index']);
		Route::get('/list', ['middleware' => 'permission:escalate_to_service', 'uses' => 'AdminEscalateToServiceController@list']);
		Route::get('/export', ['middleware' => 'permission:escalate_to_service', 'uses' => 'AdminEscalateToServiceController@export']);
		Route::get('/view/{id}', ['middleware' => 'permission:escalate_to_service', 'uses' => 'AdminEscalateToServiceController@show']);
	});
});