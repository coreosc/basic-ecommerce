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

Route::get('/home', 'HomeController@index');

//Ajax actions
Route::get('/cart-state', 'CartController@cartState')->name('cart.state');

Route::get('/koszyk', 'CartController@index')->name('cart');
Route::post('/dodaj-do-koszyka/{product}', 'CartController@add')->name('cart.add');
Route::post('/usun-z-koszyka/{product}', 'CartController@remove')->name('cart.remove');

Route::get('/koszyk/zaloz-konto', 'RegisterController@showRegistrationForm');
Route::post('/koszyk/zaloz-konto', 'RegisterController@processRegistrationForm')->name('register.process');

Route::get('/kasa/', 'CheckoutController@checkout')->name('checkout');

Route::post('/koszyk/zaloz-konto', 'RegisterController@processRegistrationForm')->name('register.process');


//@TODO add all vue prefixes
Route::post('/update-cart', 'CartController@updateCart')->name('cart.update');
Route::post('/vue/adres', 'UserController@upsertAddress')->name('user.upsertDeliveryAddress');




//One level category or manufacturer
Route::get('/{slug}/', 'SlugController@route');

//Two levels category
Route::get('/{slug1}/{slug2}/', 'SlugController@nestedRoute');

