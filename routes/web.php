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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');

// Profile
Route::get('{user_id}/profile', 'HomeController@profile')->name('profile');
Route::get('{user_id}/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::patch('{user_id}/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::patch('{user_id}/profile/logo', 'HomeController@profileLogo')->name('profile.logo');
Route::get('{user_id}/profile/change_password', 'HomeController@changePassword')->name('change.password');
Route::patch('{user_id}/profile/change_password_update', 'HomeController@changePasswordUpdate')->name('change.password.update');

Route::get('{user_id}/settings', 'HomeController@settings')->name('settings');

// Cart and Order
Route::get('create/cart', 'OrderController@createCartView')->name('create.cart');
Route::post('create/cart', 'OrderController@createCartPost')->name('post.cart');
Route::get('{cart_id}/cart', 'OrderController@cartView')->name('view.cart');
Route::patch('{cart_id}/place_order', 'OrderController@placeOrder')->name('place.order');
Route::get('{cart_id}/receipt', 'OrderController@receipt')->name('receipt');
Route::get('{user_id}/orders', 'HomeController@currentOrders')->name('current.orders');
Route::patch('{user_id}/finish_order/{id}', 'HomeController@finishOrder')->name('finish.order');
Route::patch('{user_id}/discard_order/{id}', 'HomeController@discardOrder')->name('discard.order');
Route::patch('{user_id}/finish_cart/{id}', 'HomeController@finishCart')->name('finish.cart');
Route::patch('{user_id}/discard_cart/{id}', 'HomeController@discardCart')->name('discard.cart');
Route::resource('{cart_id}/order', 'OrderController');

// Menu
Route::resource('{user_id}/category', 'CategoryController');
Route::resource('{user_id}/menu', 'MenuController');
Route::patch('{user_id}/menu/{id}/update_photo', 'MenuController@changeMenuPhoto')->name('change.menu.photo');
Route::patch('{user_id}/menu/{id}/change_featured', 'MenuController@changeFeatured')->name('change.featured');

// Addon
Route::resource('{user_id}/addon', 'AddonController');
Route::patch('{user_id}/addon/{id}/change_featured', 'AddonController@changeFeatured')->name('change.featured');

// inventory
Route::resource('{user_id}/inventory', 'InventoryController');