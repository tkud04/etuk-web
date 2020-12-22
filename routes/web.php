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
Route::post('/', 'MainController@getIndex');
Route::get('temp', 'MainController@getTemp');
Route::get('about', 'MainController@getAbout');
Route::get('faq', 'MainController@getFAQ');
Route::get('terms', 'MainController@getTerms');
Route::get('privacy', 'MainController@getPrivacy');
Route::get('contact', 'MainController@getContact');
Route::post('contact', 'MainController@postContact');

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

Route::get('messages', 'MainController@getMessages');



//Guests
Route::get('apartments', 'MainController@getApartments');
Route::get('apartment', 'MainController@getApartment');
Route::get('chat-history', 'MainController@getChatHistory');
Route::get('chat', 'MainController@getChat');
Route::get('reserve-apartment', 'MainController@getReserveApartment');
Route::get('test-chat', 'MainController@getTestChat');
Route::post('chat', 'MainController@postChat');
Route::post('add-review', 'MainController@postAddReview');
Route::get('vote-review', 'MainController@getVoteReview');
Route::get('saved-payments', 'MainController@getSavedPayments');
Route::get('remove-saved-payment', 'MainController@getRemoveSavedPayment');
Route::get('saved-apartments', 'MainController@getSavedApartments');
Route::get('save-apartment', 'MainController@getSaveApartment');
Route::get('remove-saved-apartment', 'MainController@getRemoveSavedApartment');
Route::get('apartment-preferences', 'MainController@getApartmentPreferences');
Route::post('apartment-preferences', 'MainController@postApartmentPreferences');

Route::get('cart', 'MainController@getCart');
Route::get('update-cart', 'MainController@getUpdateCart');
Route::get('add-to-cart', 'MainController@getAddToCart');
Route::get('remove-from-cart', 'MainController@getRemoveFromCart');
Route::get('checkout', 'MainController@getCheckout');
Route::post('checkout', 'MainController@postCheckout');
Route::get('bookings', 'MainController@getOrders');
Route::get('receipt', 'MainController@getReceipt');

Route::post('ssf', 'MainController@postSSF');
Route::post('search', 'MainController@postSearch');
Route::get('search', 'MainController@getSearch');
Route::get('landing-search', 'MainController@getLandingSearch');
Route::get('tb', 'MainController@getTestBomb');


//Hosts
Route::get('my-apartments', 'MainController@getMyApartments');
Route::get('add-apartment', 'MainController@getAddApartment');
Route::post('add-apartment', 'MainController@postAddApartment');
Route::get('my-apartment', 'MainController@getMyApartment');
Route::post('my-apartment', 'MainController@postMyApartment');
Route::get('delete-apartment', 'MainController@getDeleteApartment');

Route::get('analytics', 'MainController@getAnalytics');
Route::get('host-analytics', 'MainController@getHostAnalytics');

Route::get('sci', 'MainController@getSetCoverImage');
Route::get('ri', 'MainController@getRemoveImage');
Route::get('tcdi', 'MainController@getTCDI');

//Blog
Route::get('blog', 'MainController@getPosts');
Route::get('post', 'MainController@getPost');

//Payments
Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::get('payment/rc', 'PaymentController@getPayWithSavedPayment');
Route::get('pay', 'PaymentController@getPay');
Route::post('pay', 'PaymentController@postRedirectToGateway');

Route::post('subscribe', 'MainController@postSubscribe');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('bomb', 'MainController@getBomb');
Route::get('text', 'MainController@getText');

//Autocomplete
Route::get('ac', 'MainController@getAutoComplete');