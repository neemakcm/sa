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


Route::group(['prefix' => '/admin/homePage'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@index']);
		Route::get('/list/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@list']);
		Route::get('/detailList', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@detailList']);
		Route::get('/delete/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@delete']);
		Route::get('/add/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@add']);
		Route::post('/store', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@edit']);
		Route::post('/update', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@update']);
		Route::post('/sub-category', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@productCategory']);
		Route::get('/view/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@subCategoryList']);
		Route::get('/sub-category/delete/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@deleteCategory']);
		Route::get('/sub-category/restore/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@restoreCategory']);
Route::post('/other-product/sub-category/delete', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@deleteSubCategory']);
		Route::post('/other-product/update/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@updateOtherProduct']);
        		Route::get('/other-product/edit/{id}', ['middleware' => 'permission:home_page', 'uses' => 'AdminHomeDesignController@otherProductEdit']);


	});
});


Route::group(['prefix' => '/admin/pages'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminPagesController@index']);
		Route::get('/list', ['uses' => 'AdminPagesController@list']);
		Route::get('/add', ['uses' => 'AdminPagesController@add']);
		Route::post('/store', ['uses' => 'AdminPagesController@store']);
		Route::get('/edit/{id}', ['uses' => 'AdminPagesController@edit']);
		Route::post('/update', ['uses' => 'AdminPagesController@update']);
		Route::get('/service-policy', ['uses' => 'AdminPagesController@servicePolicyEdit']);
		Route::get('/drop-point', ['uses' => 'AdminPagesController@dropPointEdit']);

	});
});


Route::group(['prefix' => '/admin/milestones'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminMilestoneController@index']);
		Route::get('/list', ['uses' => 'AdminMilestoneController@list']);
		Route::get('/add', ['uses' => 'AdminMilestoneController@add']);
		Route::post('/store', ['uses' => 'AdminMilestoneController@store']);
		Route::get('/edit/{id}', ['uses' => 'AdminMilestoneController@edit']);
		Route::get('/delete/{id}', ['uses' => 'AdminMilestoneController@delete']);
		Route::post('/update', ['uses' => 'AdminMilestoneController@update']);
	});
});

Route::group(['prefix' => '/admin/awards'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminAwardController@index']);
		Route::get('/list', ['uses' => 'AdminAwardController@list']);
		Route::get('/add', ['uses' => 'AdminAwardController@add']);
		Route::post('/store', ['uses' => 'AdminAwardController@store']);
		Route::get('/delete/{id}', ['uses' => 'AdminAwardController@delete']);
		Route::get('/edit/{id}', ['uses' => 'AdminAwardController@edit']);
		Route::post('/update', ['uses' => 'AdminAwardController@update']);
	});
});

Route::group(['prefix' => '/admin/managements'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminManagementController@index']);
		Route::get('/list', ['uses' => 'AdminManagementController@list']);
		Route::get('/add', ['uses' => 'AdminManagementController@add']);
		Route::post('/store', ['uses' => 'AdminManagementController@store']);
		Route::get('/delete/{id}', ['uses' => 'AdminManagementController@delete']);
		Route::get('/edit/{id}', ['uses' => 'AdminManagementController@edit']);
		Route::post('/update', ['uses' => 'AdminManagementController@update']);
	});
});

Route::group(['prefix' => '/admin/brands'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'AdminBrandController@index']);
		Route::get('/list', ['uses' => 'AdminBrandController@list']);
		Route::get('/add', ['uses' => 'AdminBrandController@add']);
		Route::post('/store', ['uses' => 'AdminBrandController@store']);
		Route::get('/delete/{id}', ['uses' => 'AdminBrandController@delete']);
		Route::get('/edit/{id}', ['uses' => 'AdminBrandController@edit']);
		Route::post('/update', ['uses' => 'AdminBrandController@update']);
	});
});

Route::group(['prefix' => '/admin/values'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['uses' => 'CoreValuesController@index']);
		Route::get('/list', ['uses' => 'CoreValuesController@list']);
		Route::get('/add', ['uses' => 'CoreValuesController@add']);
		Route::post('/store', ['uses' => 'CoreValuesController@store']);
		Route::get('/delete/{id}', ['uses' => 'CoreValuesController@delete']);
		Route::get('/edit/{id}', ['uses' => 'CoreValuesController@edit']);
		Route::post('/update/{id}', ['uses' => 'CoreValuesController@update']);
	});
});

// Route::get('/', 'PagesController@home');
Route::get('/', 'PagesController@home')->middleware('page-cache');
Route::post('/postOfferInterest', 'PagesController@postOfferInterest');
Route::post('/imageUpload', 'PagesController@imageUpload');
Route::post('/imageUploadOverview', 'PagesController@imageUploadOverview');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/service-policy', 'PagesController@servicePolicy');
Route::get('/privacy-policy', 'PagesController@privacyPolicy');
Route::get('/terms', 'PagesController@termsConditions');
Route::get('/service-support', 'PagesController@serviceSupport');
Route::get('/product-support', 'PagesController@productSupport');
Route::get('/accept-cookie', 'PagesController@acceptCookie');
Route::get('/warranty-terms', 'PagesController@warrantytermsConditions');
Route::get('/new-launches-products', 'PagesController@newLaunchesProducts');



