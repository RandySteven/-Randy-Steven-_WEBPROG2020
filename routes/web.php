<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'ProductController@index')->name('product.index');
Route::get('/show-product/{product:slug}', 'ProductController@show')->name('product.show');
Route::get('/category/{category:slug}', 'CategoryController@show')->name('category');
Route::get('/search/', 'SearchController@search')->name('search');
Route::middleware('role:admin')->group(function(){
    Route::get('/create-product', 'ProductController@create')->name('product.create');
    Route::post('/create-product', 'ProductController@store')->name('product.store');
    Route::get('/edit-product/{product:slug}', 'ProductController@edit')->name('product.edit');
    Route::patch('/update-product/{product:slug}', 'ProductController@update')->name('product.update');
    Route::delete('/delete-product/{product:slug}', 'ProductController@delete')->name('product.delete');


});

Route::middleware('auth')->group(function($c){
    Route::post('/cart/store', 'CartController@store')->name('cart.store');
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::delete('/cart/delete/{cart}', 'CartController@delete')->name('cart.delete');

    Route::post('/comment', 'CommentController@store')->name('comment');
    Route::post('/reply', 'CommentController@storeReply')->name('reply');
    Route::post('/transaction', 'TransactionController@store')->name('transaction');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
