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

Route::get('/', 'MainController@getIndex');
Route::get('shop', 'MainController@getShop');
Route::get('new-arrivals', 'MainController@getNewArrivals');
Route::get('best-sellers', 'MainController@getBestSellers');
Route::get('product', 'MainController@getProduct');

Route::get('cart', 'MainController@getCart');

Route::get('checkout', 'MainController@getCheckout');
Route::post('checkout', 'MainController@postCheckout');
Route::get('contact', 'MainController@getContact');
Route::post('contact', 'MainController@postContact');
Route::get('search', 'MainController@getSearch');
Route::get('about', 'MainController@getAbout');
Route::get('faq', 'MainController@getFAQ');
Route::get('privacy-policy', 'MainController@getPrivacyPolicy');
Route::get('returns', 'MainController@getReturnPolicy');

Route::get('orders', 'MainController@getOrders');
Route::get('anon-order', 'MainController@getAnonOrder');
Route::post('anon-order', 'MainController@postAnonOrder');
Route::get('receipt', 'MainController@getReceipt');
Route::get('track', 'MainController@getTrack');
Route::get('confirm-payment', 'MainController@getConfirmPayment');
Route::post('confirm-payment', 'MainController@postConfirmPayment');

Route::get('login', 'LoginController@getLogin');
Route::get('register', 'LoginController@getRegister');
Route::post('login', 'LoginController@postLogin');
Route::post('register', 'LoginController@postRegister');

Route::get('forgot-password', 'LoginController@getForgotPassword');
Route::post('forgot-password', 'LoginController@postForgotPassword');
Route::get('reset', 'LoginController@getPasswordReset');
Route::post('reset', 'LoginController@postPasswordReset');

Route::get('signout', 'LoginController@getLogout');

Route::get('dashboard', 'MainController@getDashboard');
Route::get('profile', 'MainController@getProfile');
Route::post('profile', 'MainController@postProfile');

Route::post('add-review', 'MainController@postAddReview');

Route::get('add-to-cart', 'MainController@getAddToCart');
Route::get('update-cart', 'MainController@getUpdateCart');
Route::get('remove-from-cart', 'MainController@getRemoveFromCart');


Route::get('wishlist', 'MainController@getWishlist');
Route::get('add-to-wishlist', 'MainController@getAddToWishlist');
Route::get('remove-from-wishlist', 'MainController@getRemoveFromWishlist');
Route::get('add-to-compare', 'MainController@getAddToCompare');
Route::get('remove-from-compare', 'MainController@getRemoveFromCompare');
Route::get('compare', 'MainController@getCompare');

Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::get('pay', 'MainController@getPay');
Route::post('pay', 'PaymentController@postRedirectToGateway');

Route::post('subscribe', 'MainController@postSubscribe');

Route::post('sync-data', 'MainController@postSyncData');
Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('bomb', 'MainController@getBomb');
Route::get('pdf', 'MainController@getPDFTest');
Route::get('gdf', 'MainController@getDeliveryFee');

Route::get('error', 'MainController@getError');
Route::get('cps', 'MainController@getCpsTest');
