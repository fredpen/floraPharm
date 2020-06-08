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
    Route::get('delete', 'ProductController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show', 'ProductController@show');
    Route::get('all', 'BrandController@all');

    // relationships
    Route::get('brand/{brandId}', 'BrandController@brand');
    Route::get('category/{categoryId}', 'BrandController@category');
    Route::get('sub-category/{subCategoryId}', 'BrandController@subCategory');
    Route::get('best-sellers', 'BrandController@bestSellers');
    Route::get('featured', 'BrandController@featured');
    Route::get('hot', 'BrandController@hot');
    Route::get('new', 'BrandController@new');
    Route::get('landing_page', 'BrandController@landing_page');
  

});

