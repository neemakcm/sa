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
Route::group(['prefix' => '/admin/shopping-faq'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@index']);
		Route::get('/list', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@delete']);
		Route::get('/add', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@add']);
		Route::post('/store', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@edit']);
		Route::post('/update', ['middleware' => 'permission:shopping_faq', 'uses' => 'AdminShoppingFaqController@update']);
	});
});
Route::prefix('shopping-faq')->group(function() {
    Route::get('/', 'ShoppingFaqController@index');
	Route::post('/get-faq-list','ShoppingFaqController@getFaqList')->name('get.shopping.faq.list');

});
