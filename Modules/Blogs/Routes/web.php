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
Route::group(['prefix' => '/admin/blog'], function()
{
    Route::group(['middleware' => 'admin_auth:admin'], function(){
        Route::get('/', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@index']);
        Route::get('/list', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@list']);
        // Route::get('/delete/{id}', ['middleware' => 'permission:media-center', 'uses' => 'AdminMediaCenterController@delete']);
        Route::get('/add', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@add']);
        Route::post('/store', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@store']);
        Route::get('/delete/{id}', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@delete']);
        Route::get('/edit/{id}', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@edit']);
        Route::post('/update', ['middleware' => 'permission:latest_blogs', 'uses' => 'AdminBlogsController@update']);
    });
});
Route::prefix('blogs')->group(function() {
    Route::get('/', 'BlogsController@index');
    Route::get('/pagination', 'BlogsController@pageIndex');
    Route::get('/details/{id}', 'BlogsController@details');

});
Route::prefix('news')->group(function() {
    
    Route::get('/pagination', 'BlogsController@newsPagiation');
     Route::get('/details/{id}', 'BlogsController@newsDetails');
});
Route::prefix('videos')->group(function() {
    
    Route::get('/pagination', 'BlogsController@videoPagiation');
});
