<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'Auth\RegisterController@getUser');
});
Route::get('website-details', 'DeliveryLocationController@websiteDetails');
Route::post('contact-us', 'WebManagementController@mailAdmin');

Route::get('admin-Landing-Page-Products', 'WebManagementController@adminLandingPageProducts')->middleware(['auth:api', 'isAdmin']);


// users
Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'Auth\RegisterController@create');
    Route::get('all', 'Auth\RegisterController@allUsers');
    Route::post('login', 'Auth\LoginController@authenticate');
    Route::resource('address', 'UserAddressController')->middleware('auth:api');
    Route::get('detail', 'UserAddressController@userDetail')->middleware('auth:api');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@forgotPassword');
    Route::post('change-password', 'Auth\ForgotPasswordController@changePassword');
});

// category
Route::group(['prefix' => 'category'], function () {
    Route::post('create', 'CategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'CategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{categoryId}', 'CategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{categoryId}', 'CategoryController@show');
    Route::get('all-categories', 'CategoryController@all');
    Route::get('admin/all-categories', 'CategoryController@adminAll');
    Route::get('all-categories-without-sub', 'CategoryController@allWithoutSub');
});


// orders
Route::group(['prefix' => 'order'], function () {
    Route::post('make-order', 'OrderController@makePayment')->middleware('auth:api');
    Route::post('guest-order', 'OrderController@makePayment');
    Route::post('verify-guest-transaction', 'OrderController@verifyTransaction');
    Route::post('verify-transaction', 'OrderController@verifyTransaction')->middleware('auth:api');
    Route::get('', 'OrderController@getUserOrder')->middleware('auth:api');
    Route::get('show/{orderId}', 'OrderController@getSingleOrder')->middleware('auth:api');
    Route::get('show-with-ref/{ref}', 'OrderController@showWithRef')->middleware();
    Route::get('all', 'OrderController@allOrder')->middleware(['auth:api', 'isAdmin']);
    Route::post('save-transaction', 'OrderController@saveTransactionRef');
    Route::post('save-transaction-auth-user', 'OrderController@saveTransactionRefForAuthUser')->middleware('auth:api');
    Route::post('search-order', 'OrderController@searchOrder')->middleware(['auth:api', 'isAdmin']);
});

// subcategory
Route::group(['prefix' => 'sub-category'], function () {
    Route::post('create', 'SubCategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'SubCategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{subCategoryId}', 'SubCategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{subCategoryId}', 'SubCategoryController@show');
    Route::get('all-sub-categories', 'SubCategoryController@all');
});

//delivery location
Route::group(['prefix' => 'delivery-location'], function () {
    Route::post('add', 'DeliveryLocationController@addLocation')->middleware(['auth:api', 'isAdmin']);
    Route::post('update/{id}', 'DeliveryLocationController@updateLocation')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{id}', 'DeliveryLocationController@deleteLocation')->middleware(['auth:api', 'isAdmin']);
    Route::get('/', 'DeliveryLocationController@locations');
    Route::get('/admin/all', 'DeliveryLocationController@adminLocations')->middleware(['auth:api', 'isAdmin']);
});


// brands
Route::group(['prefix' => 'brand'], function () {
    Route::post('create', 'BrandController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'BrandController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{brandId}', 'BrandController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{brandId}', 'BrandController@show');
    Route::get('all', 'BrandController@all');
    Route::get('admin/all', 'BrandController@adminAll');
});


// products
Route::group(['prefix' => 'product'], function () {
    Route::post('create', 'ProductController@create');
    Route::post('edit', 'ProductController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{productId}', 'ProductController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{productId}', 'ProductController@show');
    Route::get('all', 'ProductController@all');
    Route::get('search/{searchTerm}', 'ProductController@search');
    Route::get('admin/all', 'ProductController@adminAll');
    Route::get('active', 'ProductController@active');

    // relationships
    Route::get('order-notifications/{productId}', 'ProductController@orderNotifications');
    Route::get('home-page', 'ProductController@homePage');
    Route::get('brand/{brandId}', 'ProductController@brand');
    Route::get('admin/brand/{brandId}', 'ProductController@adminBrand');
    Route::get('category/{categoryId}', 'ProductController@category');
    Route::get('admin/category/{categoryId}', 'ProductController@adminCategory');
    Route::get('sub-category/{subCategoryId}', 'ProductController@subCategory');
    Route::get('best-sellers', 'ProductController@bestSellers');
    Route::get('featured', 'ProductController@featured');
    Route::get('hot', 'ProductController@hot');
    Route::get('new', 'ProductController@new');
    Route::get('landing_page', 'ProductController@landingPage');
    Route::post('filter', 'ProductController@filterProducts');
});

//top pick, hot, new, featured

// wishlist
Route::group(['prefix' => 'wishlist', 'middleware' => 'auth:api'], function () {
    Route::post('add', 'WishListController@add');
    Route::get('remove/{productId}', 'WishListController@remove');
    Route::get('clear', 'WishListController@clear');
    Route::get('all', 'WishListController@all');
});

// cart
Route::group(['prefix' => 'cart', 'middleware' => 'auth:api'], function () {
    //call this endpoint for removal too just pass zero as quantity
    Route::post('update', 'CartController@update');
    Route::get('clear', 'CartController@clear');
    Route::get('my-cart', 'CartController@fetch');
    Route::get('all', 'CartController@all')->middleware('isAdmin'); //for admin
});
