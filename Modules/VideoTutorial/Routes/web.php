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
Route::group(['prefix' => '/admin/video-tutorials'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@index']);
		Route::get('/list', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@delete']);
		Route::get('/add', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@add']);
		Route::post('/store', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@store']);
		Route::get('/edit/{id}', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@edit']);
		Route::post('/update', ['middleware' => 'permission:video_tutorial', 'uses' => 'AdminVideoTutorialController@update']);
	});
});
// 
Route::prefix('video-tutorials')->group(function() {
    Route::get('/', 'VideoTutorialController@index');
    Route::get('/pagination', 'VideoTutorialController@pageIndex');
    
    Route::post('/by-category', 'VideoTutorialController@index');
});
