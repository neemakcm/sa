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

Route::prefix('careers')->group(function() 
{
    Route::get('/', 'CareersController@index');
    Route::get('/search', 'CareersController@search');
    Route::get('/detail/{slug}', 'CareersController@detail');
    Route::post('/submitJobRequest', 'CareersController@submitJobRequest');
});

Route::get('/workingAtImpex', 'CareersController@working');
Route::get('/jobFields', 'CareersController@jobFields');

Route::group(['prefix' => '/admin/jobFields'], function()
{
    Route::group(['middleware' => 'admin_auth:admin'], function(){
        Route::get('/', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@index']);
        Route::get('/list', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@list']);
        Route::get('/delete/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@delete']);
        Route::get('/add', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@add']);
        Route::post('/store', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@store']);
        Route::get('/delete/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@delete']);
        Route::get('/edit/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@edit']);
        Route::post('/update', ['middleware' => 'permission:careers', 'uses' => 'AdminJobFieldsController@update']);
    });
});

Route::group(['prefix' => '/admin/jobs'], function()
{
    Route::group(['middleware' => 'admin_auth:admin'], function(){
        Route::get('/', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@index']);
        Route::get('/list', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@list']);
        Route::get('/delete/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@delete']);
        Route::get('/add', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@add']);
        Route::post('/store', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@store']);
        Route::get('/delete/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@delete']);
        Route::get('/edit/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@edit']);
        Route::post('/update', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@update']);

        Route::get('/requests/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@requestIndex']);
        Route::get('/requestList', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@requestList']);
        Route::get('/requests/view/{id}', ['middleware' => 'permission:careers', 'uses' => 'AdminJobsController@requestView']);
    });
});