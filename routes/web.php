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

Route::group(['middleware'=>'guest'],function () {
    Route::get('/', 'LoginAndRegisterController@index')->name('login');
    Route::get('/signup', 'LoginAndRegisterController@signup')->name('signup');
    Route::post('/register', 'LoginAndRegisterController@store')->name('register');
    Route::post('/login', 'LoginAndRegisterController@login')->name('signin');
});


Route::group(['middleware'=>'auth'],function () {
//products
    Route::get('/view_products', 'ProductController@view_products')->name('view_products');
    Route::post('/save_product', 'ProductController@store')->name('save_product');


//order
    Route::get('/order_placed', 'OrderController@order_placed')->name('order_placed');
    Route::get('/pending_order', 'OrderController@pending_order')->name('pending_order');
    Route::get('/receipt/{id}', 'OrderController@receipt')->name('receipt');

    //logout
    Route::get('/logout', 'LoginAndRegisterController@logout')->name('logout');
});



