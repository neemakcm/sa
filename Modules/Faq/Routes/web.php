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

Route::group(['prefix' => '/admin/faq'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@index']);
		Route::get('/list', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@delete']);
		Route::get('/add', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@add']);
		Route::post('/store', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@edit']);
		Route::post('/update', ['middleware' => 'permission:faq', 'uses' => 'AdminFaqController@update']);
	});
});
Route::prefix('faq')->group(function() {
    Route::get('/', 'FaqController@index');
	Route::post('/get-faq-list','FaqController@getFaqList')->name('get.faq.list');

});

