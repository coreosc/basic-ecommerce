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

Route::get('/cart-state', 'CartController@cartState')->name('cart.state');
Route::post('/update-cart', 'CartController@updateCart')->name('cart.update');
Route::get('/koszyk', 'CartController@index')->name('cart');
Route::post('/dodaj-do-koszyka/{product}', 'CartController@add')->name('cart.add');
Route::post('/usun-z-koszyka/{product}', 'CartController@remove')->name('cart.remove');


//One level category or manufacturer
Route::get('/{slug}/', 'SlugController@route');

//Two levels category
Route::get('/{slug1}/{slug2}/', 'SlugController@nestedRoute');

