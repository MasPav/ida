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

Route::middleware(['auth'])->group(function () {
    Route::get('admin', function () {
        return view('admin.dashboard');
    });
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('login', 'AuthController@login')->name('login');
