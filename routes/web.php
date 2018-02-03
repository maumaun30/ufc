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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');

Route::get('create/cart', 'OrderController@createCartView')->name('create.cart');

Route::post('create/cart', 'OrderController@createCartPost')->name('post.cart');

Route::get('{cart_id}/cart', 'OrderController@cartView')->name('view.cart');

Route::patch('{cart_id}/place_order', 'OrderController@placeOrder')->name('place.order');

Route::get('{cart_id}/receipt', 'OrderController@receipt')->name('receipt');

Route::resource('{cart_id}/order', 'OrderController');

Route::resource('profile/{user_id}/menu', 'MenuController');

Route::resource('profile/{user_id}/inventory', 'InventoryController');
