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

Route::group(['prefix' => '/admin/products'], function()
{
	Route::group(['middleware' => 'admin_auth:admin'], function(){
		Route::get('/', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@index']);
		Route::get('/list', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@list']);
		Route::get('/delete/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@delete']);
		Route::get('/add', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@add']);
		Route::post('/store', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@store']);
		Route::get('/overview/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@overview']);
		Route::post('/updateOverview', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@updateOverview']);
		Route::get('/getProductBasics/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@getProductBasics']);
		Route::get('/edit/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@edit']);
		Route::post('/update', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@update']);
		Route::get('/getCategoryAttributes/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@getCategoryAttributes']);
		Route::get('/deleteImage/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@deleteImage']);
		Route::get('/resizeImage/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@resizeImage']);
	


		Route::get('varient/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientIndex']);
		Route::get('varientList', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientList']);
		Route::get('varient/delete/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientDelete']);
		Route::get('varient/add/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientAdd']);
		Route::post('varient/store', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientStore']);
		Route::get('varient/edit/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientEdit']);
		Route::post('varient/update', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientUpdate']);
		Route::get('varient/deleteImage/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@varientDeleteImage']);
	


		Route::get('support/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportIndex']);
		Route::get('supportList', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportList']);
		Route::get('support/delete/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportDelete']);
		Route::get('support/add/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportAdd']);
		Route::post('support/store', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportStore']);
		Route::get('support/edit/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportEdit']);
		Route::post('support/update', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@supportUpdate']);
	


		Route::get('pendingReviews', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@pendingReviews']);
		Route::get('pendingReviewsList', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@pendingReviewsList']);
		Route::get('approveReviews/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@approveReviews']);
		Route::get('rejectReviews/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@rejectReviews']);

		Route::get('reviews/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsIndex']);
		Route::get('reviewsList', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsList']);
		Route::get('reviews/delete/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsDelete']);
		Route::get('reviews/add/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsAdd']);
		Route::post('reviews/store', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsStore']);
		Route::get('reviews/edit/{id}', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsEdit']);
		Route::post('reviews/update', ['middleware' => 'permission:product_review', 'uses' => 'AdminProductsController@reviewsUpdate']);
	


		Route::get('faq/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqIndex']);
		Route::get('faqList', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqList']);
		Route::get('faq/delete/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqDelete']);
		Route::get('faq/add/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqAdd']);
		Route::post('faq/store', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqStore']);
		Route::get('faq/edit/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqEdit']);
		Route::post('faq/update', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@faqUpdate']);


		Route::get('/registered', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@registered']);
		Route::get('/registered/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@registeredView']);
		// Route::get('/registeredList', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@registeredList']);
		Route::post('/registeredListPost', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@registeredList']);
		Route::post('/registeredExport', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@registeredProductExport']);


		Route::get('/feedback', ['uses' => 'AdminProductsController@feedback']);
		Route::get('/feedback/{id}', ['uses' => 'AdminProductsController@feedbackView']);
		Route::get('/feedbackList', ['uses' => 'AdminProductsController@feedbackList']);
		Route::get('/feedbackExport', ['uses' => 'AdminProductsController@feedbackExport']);
		Route::post('/product-feedback-export', ['uses' => 'AdminProductsController@productFeedbackExport']);


		Route::get('/get-vendor', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@vendorList']);
		Route::get('/vendor/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@vendorsList']);
		Route::get('/vendorList', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@productVendorList']);
		Route::get('vendor/delete/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@vendorDelete']);
		Route::post('vendor/store/{id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@vendorStore']);
		Route::get('deleteProductVendor/{online}/{product_id}', ['middleware' => 'permission:products', 'uses' => 'AdminProductsController@deleteProductVendor']);
		
		});
});

Route::get('/createSlug', ['uses' => 'AdminProductsController@createSlug']);
Route::get('/createThumbnail', ['uses' => 'AdminProductsController@createThumbnail']);

Route::group(['prefix' => 'products'], function()
{
	Route::get('/{id}', ['uses' => 'ProductsController@index']);
	Route::get('/detail/{sku}', ['uses' => 'ProductsController@detail']);
	Route::get('/getProductBasics/{sku}', ['uses' => 'ProductsController@getProductBasics']);
	Route::post('/getModelNumber', ['uses' => 'ProductsController@getModelNumber']);
	Route::get('/getCategoryTypes/{id}', ['uses' => 'ProductsController@getCategoryTypes']);
	Route::get('/getFeedbackCategoryTypes/{id}', ['uses' => 'ProductsController@getFeedbackCategoryTypes']);
	Route::get('/getCategoryModels/{id}', ['uses' => 'ProductsController@getCategoryModels']);
	Route::post('/addToCompare', ['uses' => 'ProductsController@addToCompare']);
	Route::post('/clearCompare', ['uses' => 'ProductsController@clearCompare']);

});

Route::get('/productSearch', ['uses' => 'ProductsController@productSearch']);
Route::get('/compare', ['uses' => 'ProductsController@compare']);
Route::get('/productRegister', ['uses' => 'ProductsController@productRegister']);
Route::post('/storeProductRegister', ['uses' => 'ProductsController@storeProductRegister']);
Route::get('/productFeedback', ['uses' => 'ProductsController@productFeedback']);
Route::post('/storeProductFeedback', ['uses' => 'ProductsController@storeProductFeedback']);
Route::post('/postReview', ['uses' => 'ProductsController@postReview']);