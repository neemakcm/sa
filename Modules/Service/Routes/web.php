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

Route::prefix('service')->group(function() {
    Route::get('/', 'ServiceController@index');
    Route::post('/requestService', 'ServiceController@requestService');
    Route::get('/track', 'ServiceController@track');
    Route::post('/trackService', 'ServiceController@trackService');
    Route::get('/centers', 'ServiceController@centers');
    Route::get('/getStateDistricts/{id}', 'ServiceController@getStateDistricts');
    Route::get('/map-content', ['uses' => 'ServiceController@mapContent']);
	Route::get('/district-drop', ['uses' => 'ServiceController@districtDrop']);
});


Route::group(['prefix' => '/admin/service'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@index']);
		Route::get('/list', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@list']);
		Route::post('/updateComplaint', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@updateComplaint']);
		Route::post('/service-request-export', ['uses' => 'AdminServiceController@serviceExport']);

		Route::get('/view/{id}', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@view']);
		// Route::get('/serviceExport', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@serviceExport']);
		Route::post('/updateStatus', ['middleware' => 'permission:services', 'uses' => 'AdminServiceController@updateStatus']);

		Route::get('/feedback', ['uses' => 'AdminServiceController@feedback']);
		Route::get('/feedback/{id}', ['uses' => 'AdminServiceController@feedbackView']);
		Route::get('/feedbackList', ['uses' => 'AdminServiceController@feedbackList']);
		Route::post('/feedbackListPost', ['uses' => 'AdminServiceController@feedbackListPost']);
		Route::get('/feedbackExport', ['uses' => 'AdminServiceController@feedbackExport']);
		Route::post('/service-feedback-export', ['uses' => 'AdminServiceController@servicefeedbackExport']);
	});
});


Route::group(['prefix' => '/admin/serviceCenters'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@index']);
		Route::get('/list', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@list']);
		Route::get('/export', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@export']);
		Route::get('/delete/{id}', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@delete']);
		Route::get('/add', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@add']);
		Route::post('/store', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@edit']);
		Route::post('/update', ['middleware' => 'permission:service_center', 'uses' => 'AdminServiceCenterController@update']);
	});
});


Route::get('/serviceFeedback', 'ServiceController@serviceFeedback');
Route::post('/storeServiceFeedback', 'ServiceController@storeServiceFeedback');