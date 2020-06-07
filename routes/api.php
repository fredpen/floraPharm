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

Route::group(['prefix' => 'category'], function () {
    Route::post('create', 'CategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'CategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete', 'CategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show/{categoryId}', 'CategoryController@show');
    Route::get('all-categories', 'CategoryController@all');
    Route::get('all-categories-with-sub-categories', 'CategoryController@categoriesWithSubCategories');
});

Route::group(['prefix' => 'sub-category'], function () {
    Route::post('create', 'SubCategoryController@create')->middleware(['auth:api', 'isAdmin']);
    Route::post('edit', 'SubCategoryController@edit')->middleware(['auth:api', 'isAdmin']);
    Route::get('delete', 'SubCategoryController@delete')->middleware(['auth:api', 'isAdmin']);
    Route::get('show', 'SubCategoryController@show');
    Route::get('all-sub-categories', 'SubCategoryController@all');
});

