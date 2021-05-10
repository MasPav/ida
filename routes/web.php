<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('products', 'ProductController@index')->name('products');
Route::get('products/search', 'ProductController@search')->name('searchProducts');
Route::get('products/{id}', 'ProductController@showProductDetails')->name('productDetails');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('', 'AdminController@index')->name('dashboard');
    Route::get('products', 'AdminController@showProducts')->name('products');
    Route::post('products', 'AdminController@storeProducts')->name('products');
    Route::patch('products/{id}', 'AdminController@updateProducts');
    Route::delete('products/{id}', 'AdminController@deleteProducts')->name('deleteProducts');
    Route::get('categories', 'AdminController@showCategories')->name('categories');
    Route::post('categories', 'AdminController@storeCategories')->name('categories');
    Route::patch('categories/{id}', 'AdminController@updateCategories');
    Route::delete('categories/{id}', 'AdminController@deleteCategories')->name('deleteCategory');
    Route::get('users', 'AdminController@showUsers')->name('users');
    Route::post('users', 'AdminController@storeUser')->name('users');
    Route::patch('users/{id}', 'AdminController@updateUser');
    Route::delete('users/{id}', 'AdminController@deleteUser')->name('deleteUser');
});

Route::get('login', 'AuthController@showLogin')->name('login');
Route::post('login', 'AuthController@login')->name('login');
Route::get('logout', 'AuthController@logout')->name('logout');
