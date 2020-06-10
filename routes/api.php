<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'Auth\RegisterController@create');
    Route::post('login', 'Auth\LoginController@authenticate');
    Route::resource('address', 'UserAddressController')->middleware('auth:api');
    Route::get('detail', 'UserAddressController@userDetail')->middleware('auth:api');
});

// category
Route::group(['prefix' => 'category'], function () {
    Route::post('create', 'CategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'CategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{categoryId}', 'CategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{categoryId}', 'CategoryController@show');
    Route::get('all-categories', 'CategoryController@all');
});

// subcategory
Route::group(['prefix' => 'sub-category'], function () {
    Route::post('create', 'SubCategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'SubCategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{subCategoryId}', 'SubCategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{subCategoryId}', 'SubCategoryController@show');
    Route::get('all-sub-categories', 'SubCategoryController@all');
});


// brands
Route::group(['prefix' => 'brand'], function () {
    Route::post('create', 'BrandController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'BrandController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{brandId}', 'BrandController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{brandId}', 'BrandController@show');
    Route::get('all', 'BrandController@all');
});

// products
Route::group(['prefix' => 'product'], function () {
    Route::post('create', 'ProductController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'ProductController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete/{productId}', 'ProductController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{productId}', 'ProductController@show');
    Route::get('all', 'ProductController@all');
    Route::get('active', 'ProductController@active');

    // relationships
    Route::get('brand/{brandId}', 'ProductController@brand');
    Route::get('category/{categoryId}', 'ProductController@category');
    Route::get('sub-category/{subCategoryId}', 'ProductController@subCategory');
    Route::get('best-sellers', 'ProductController@bestSeller');
    Route::get('featured', 'ProductController@featured');
    Route::get('hot', 'ProductController@hot');
    Route::get('new', 'ProductController@new');
    Route::get('landing-page', 'ProductController@landingPage');
});

// wishlist
Route::group( ['prefix' => 'wishlist', 'middleware' => 'auth:api'], function () {
    Route::post('add', 'WishListController@add');
    Route::get('remove/{productId}', 'WishListController@remove');
    Route::get('clear', 'WishListController@clear');
    Route::get('all', 'WishListController@all');
});

