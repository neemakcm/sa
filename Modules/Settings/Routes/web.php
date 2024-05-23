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
Route::prefix('admin/settings')->group(function() {
    Route::get('/', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@index']);
    Route::post('/store', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@store']);

});
// Route::prefix('settings')->group(function() {
//     Route::get('/', 'SettingsController@index');
// });


Route::prefix('admin/footerSettings')->group(function() {
    Route::get('/', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerIndex']);
    Route::get('/list', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerList']);
    Route::get('/add', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerAdd']);
    Route::post('/store', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerStore']);
    Route::get('/edit/{id}', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerEdit']);
    Route::post('/update', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerUpdate']);
    Route::get('/delete/{id}', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerDelete']);
});


Route::prefix('admin/footerCategorySettings')->group(function() {
    Route::get('/', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryIndex']);
    Route::get('/list', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryList']);
    Route::get('/add', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryAdd']);
    Route::post('/store', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryStore']);
    Route::get('/edit/{id}', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryEdit']);
    Route::post('/update', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryUpdate']);
    Route::get('/delete/{id}', ['middleware' => 'permission:settings', 'uses' => 'SettingsController@footerCategoryDelete']);
});