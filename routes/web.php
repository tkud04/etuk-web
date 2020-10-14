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
Route::get('temp', 'MainController@getTemp');
Route::get('about', 'MainController@getAbout');
Route::get('terms', 'MainController@getTerms');
Route::get('privacy', 'MainController@getPrivacy');

//Authentication
Route::get('signup', 'LoginController@getSignup');
Route::post('signup', 'LoginController@postSignup');
Route::get('forgot-password', 'LoginController@getForgotPassword');
Route::post('forgot-password', 'LoginController@postForgotPassword');
Route::get('reset', 'LoginController@getPasswordReset');
Route::post('reset', 'LoginController@postPasswordReset');
Route::get('hello', 'LoginController@getHello');
Route::post('hello', 'LoginController@postHello');
Route::get('bye', 'LoginController@getBye');
Route::get('oauth', 'LoginController@getOauth');
Route::get('{type}/oauth', 'LoginController@getOauthRedirect');
Route::get('oauth-sp', 'LoginController@getOAuthSP');
Route::post('oauth-sp', 'LoginController@postOAuthSP');


Route::get('dashboard', 'MainController@getDashboard');
Route::get('profile', 'MainController@getProfile');
Route::get('delete-avatar', 'MainController@getDeleteAvatar');
Route::post('profile', 'MainController@postProfile');
Route::get('sm', 'MainController@getSwitchMode');


//Guests
Route::get('apartments', 'MainController@getApartments');
Route::get('apartment', 'MainController@getApartment');
Route::get('chat-history', 'MainController@getChatHistory');
Route::get('chat', 'MainController@getChat');
Route::post('chat', 'MainController@postChat');
Route::get('checkout', 'MainController@getCheckout');
Route::post('checkout', 'MainController@postCheckout');
Route::get('search', 'MainController@getSearch');


//Hosts
Route::get('my-apartments', 'MainController@getMyApartments');
Route::get('add-apartment', 'MainController@getAddApartment');
Route::post('add-apartment', 'MainController@postAddApartment');
Route::get('my-apartment', 'MainController@getMyApartment');
Route::post('my-apartment', 'MainController@postMyApartment');
Route::get('delete-apartment', 'MainController@getDeleteApartment');

Route::get('sci', 'MainController@getSetCoverImage');
Route::get('ri', 'MainController@getRemoveImage');
Route::get('tcdi', 'MainController@getTCDI');



//Payments
Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::get('pay', 'MainController@getPay');
Route::post('pay', 'PaymentController@postRedirectToGateway');

Route::post('subscribe', 'MainController@postSubscribe');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('bomb', 'MainController@getBomb');

