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


Route::get('signup', 'LoginController@getSignup');
Route::post('signup', 'LoginController@postSignup');
Route::get('hello', 'LoginController@getHello');
Route::post('hello', 'LoginController@postHello');
Route::get('bye', 'LoginController@getBye');

Route::get('dashboard', 'MainController@getDashboard');
Route::get('sm', 'MainController@getSwitchMode');


Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::get('pay', 'MainController@getPay');
Route::post('pay', 'PaymentController@postRedirectToGateway');

Route::post('subscribe', 'MainController@postSubscribe');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('bomb', 'MainController@getBomb');

