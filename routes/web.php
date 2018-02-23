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

// Themes
Route::resource('{user_id}/themes', 'ThemeController');
Route::patch('{user_id}/themes/{id}/apply', 'ThemeController@applyTheme')->name('themes.apply');
Route::patch('{user_id}/themes/{id}/update/bgimage', 'ThemeController@updateBgImage')->name('themes.update.bgimage');

// Swiper
Route::resource('{user_id}/swiper', 'SwiperController');
Route::patch('{user_id}/swiper/{id}/change_featured', 'SwiperController@changeFeatured')->name('change.featured.swiper');


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
Route::get('{cart_id}/order/{id}/{category}', 'OrderController@indexCategory')->name('order.category');
Route::post('{cart_id}/order/addon/store', 'OrderController@storeAddon')->name('order.store.addon');
Route::get('{user_id}/{cart_id}/order/print', 'HomeController@print')->name('order.print');
Route::patch('{cart_id}/edit/{id}/quantity', 'OrderController@editQty')->name('order.edit.qty');

// Menu
Route::resource('{user_id}/category', 'CategoryController');
Route::resource('{user_id}/menu', 'MenuController');
Route::patch('{user_id}/menu/{id}/update_photo', 'MenuController@changeMenuPhoto')->name('change.menu.photo');
Route::patch('{user_id}/menu/{id}/change_featured', 'MenuController@changeFeatured')->name('change.featured.menu');

// Addon
Route::resource('{user_id}/addon_category', 'AddonCategoryController');
Route::resource('{user_id}/addon', 'AddonController');
Route::patch('{user_id}/addon/{id}/change_featured', 'AddonController@changeFeatured')->name('change.featured.addon');

// inventory
Route::resource('{user_id}/inventory', 'InventoryController');

// Sales
Route::resource('{user_id}/sales', 'SalesController');

// Feedback
Route::get('{user_id}/feedback/index', 'HomeController@indexFeedback')->name('feedback.index');
Route::post('{user_id}/feedback/store', 'HomeController@storeFeedback')->name('feedback.store');

// Rating
Route::get('{user_id}/rating/index', 'HomeController@indexRating')->name('rating.index');
Route::post('{user_id}/{id}/rating/store', 'HomeController@storeRating')->name('rating.store');