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

    //Relier admin
    Route::get('/view_admins', 'UserController@viewRelierAdmins')->name('view_admins');
    Route::post('/save_relier_admin', 'UserController@saveRelierAdmins')->name('save_relier_admin');
    Route::get('/delete_relier_admin/{id}', 'UserController@deleteRelierAdmin')->name('delete_relier_admin');

    Route::get('/view_companies', 'CompanyController@viewCompanies')->name('view_companies');
    Route::post('/save_company', 'CompanyController@saveCompany')->name('save_company');

    Route::get('/view_tokens', 'TokenController@viewTokens')->name('view_tokens');
    Route::post('/save_token', 'TokenController@saveToken')->name('save_token');


    Route::get('/view_cities', 'CityController@viewCities')->name('view_cities');
    Route::post('/save_city', 'CityController@saveCity')->name('save_city');

    Route::get('/view_customers', 'CustomerController@viewCustomers')->name('view_customers');

    Route::get('/view_outlets', 'OutletController@adminViewAllOutlets')->name('view_outlets');


    //Company admin
    Route::get('/view_products', 'ProductController@view_products')->name('view_products');
    Route::post('/save_product', 'ProductController@store')->name('save_product');
    Route::get('/view_company_outlets', 'CompanyAdminController@companyOutlets')->name('view_company_outlets');
    Route::post('/save_outlet', 'CompanyAdminController@saveOutlet')->name('save_outlet');




    //Outlet admin
    Route::get('/order_placed', 'OrderController@order_placed')->name('order_placed');
    Route::get('/pending_order', 'OrderController@pending_order')->name('pending_order');
    Route::get('/receipt/{id}', 'OrderController@receipt')->name('receipt');


    //Operator





    //logout
    Route::get('/logout', 'LoginAndRegisterController@logout')->name('logout');
});



