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

Route::get('{user_id}/profile', 'HomeController@profile')->name('profile');

Route::get('{user_id}/settings', 'HomeController@settings')->name('settings');

Route::get('create/cart', 'OrderController@createCartView')->name('create.cart');

Route::post('create/cart', 'OrderController@createCartPost')->name('post.cart');

Route::get('{cart_id}/cart', 'OrderController@cartView')->name('view.cart');

Route::patch('{cart_id}/place_order', 'OrderController@placeOrder')->name('place.order');

Route::get('{cart_id}/receipt', 'OrderController@receipt')->name('receipt');

Route::get('{user_id}/orders', 'HomeController@currentOrders')->name('current.orders');

Route::resource('{cart_id}/order', 'OrderController');

Route::resource('profile/{user_id}/menu', 'MenuController');

Route::patch('profile/{user_id}/menu/{id}/update_photo', 'MenuController@changeMenuPhoto')->name('change.menu.photo');

Route::patch('profile/{user_id}/menu/{id}/change_featured', 'MenuController@changeFeatured')->name('change.featured');

Route::resource('profile/{user_id}/inventory', 'InventoryController');