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
Auth::routes();

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/single/{id}', 'FrontendController@single')->name('single');
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/cart', 'ShoppingController@cart')->name('cart');
Route::post('/cart/add', 'ShoppingController@add_to_cart')->name('cart.add');
Route::get('/cart/delete/{id}', 'ShoppingController@delete_from_cart')->name('cart.delete');
Route::get('/cart/inc/{id}/{qty}','ShoppingController@inc')->name('cart.inc');
Route::get('/cart/dec/{id}/{qty}', 'ShoppingController@dec')->name('cart.dec');
Route::get('/cart/quickly_add/{id}', 'ShoppingController@quickly_add')->name('cart.quickly_add');
Route::get('/cart/checkout', 'CheckoutController@index')->name('cart.checkout');
Route::post('/cart/checkout', 'CheckoutController@pay')->name('cart.checkout');

Route::group(['middleware' => 'auth'], function () {

Route::resource('products', 'ProductsController');

});

