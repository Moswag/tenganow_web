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

Route::get('/logout', 'LoginAndRegisterController@logout')->name('logout');

Route::group(['middleware'=>'auth'],function () {
    Route::get('/change_password', 'PasswordController@changePassword')->name('change_password');
    Route::post('/update_password', 'PasswordController@updatePassword')->name('update_password');
});

Route::group(['namespace' => 'RelierAdmin','middleware'=>'auth'],function () {

    //Relier admin
    Route::get('/view_admins', 'UserController@viewRelierAdmins')->name('view_admins');
    Route::post('/save_relier_admin', 'UserController@saveRelierAdmins')->name('save_relier_admin');
    Route::get('/delete_relier_admin/{id}', 'UserController@deleteRelierAdmin')->name('delete_relier_admin');
    Route::get('/edit_relier_admin/{id}', 'UserController@editRelierAdmin')->name('edit_relier_admin');
    Route::post('/update_relier_admin', 'UserController@updateRelierAdmin')->name('update_relier_admin');


    Route::get('/view_companies', 'CompanyController@viewCompanies')->name('view_companies');
    Route::post('/save_company', 'CompanyController@saveCompany')->name('save_company');
    Route::get('/edit_company/{id}', 'CompanyController@editCompany')->name('edit_company');
    Route::post('/update_company', 'CompanyController@updateCompany')->name('update_company');


    Route::get('/view_tokens', 'TokenController@viewTokens')->name('view_tokens');
    Route::post('/save_token', 'TokenController@saveToken')->name('save_token');
    Route::get('/delete_token/{id}', 'TokenController@deleteToken')->name('delete_token');



    Route::get('/view_cities', 'CityController@viewCities')->name('view_cities');
    Route::post('/save_city', 'CityController@saveCity')->name('save_city');
    Route::get('/delete_city/{id}', 'CityController@deleteCity')->name('delete_city');
    Route::get('/edit_city/{id}', 'CityController@editCity')->name('edit_city');
    Route::post('/update_city', 'CityController@updateCity')->name('update_city');


    Route::get('/view_customers', 'CustomerController@viewCustomers')->name('view_customers');
    Route::get('/delete_customer/{id}', 'CustomerController@deleteCustomer')->name('delete_customer');



    Route::get('/view_outlets/{id}', 'OutletController@viewOutlets')->name('view_outlets');
    Route::get('/view_outlet_paynows', 'OutletController@viewOutletPaynow')->name('view_outlet_paynows');

    Route::post('/save_outlet_paynow', 'OutletController@addOutletToken')->name('save_outlet_paynow');

    Route::get('/delete_outlet_paynow/{id}', 'OutletController@deleteOutletPaynow')->name('delete_outlet_paynow');

    Route::get('/edit_outlet_paynow/{id}', 'OutletController@editOutletPaynow')->name('edit_outlet_paynow');

    Route::post('/update_outlet_paynow', 'OutletController@updateOutletPaynow')->name('update_outlet_paynow');


    Route::get('/view_all_sales', 'SalesController@viewAllSales')->name('view_all_sales');

    Route::get('/view_company_promotions', 'PromotionController@viewPromotions')->name('view_company_promotions');
    Route::get('/delete_company_promotion/{id}', 'PromotionController@deletePromotion')->name('delete_company_promotion');

    Route::get('/view_all_tractions', 'TransactionController@viewTransactions')->name('view_all_tractions');


});

Route::group(['namespace' => 'CompanyAdmin','middleware'=>'auth'],function () {
    //Company admin
    Route::get('/view_company_admins', 'AdminController@viewAdmins')->name('view_company_admins');
    Route::post('/save_company_admin', 'AdminController@saveAdmin')->name('save_company_admin');
    Route::get('/edit_company_admin/{id}', 'AdminController@editAdmin')->name('edit_company_admin');
    Route::post('/update_company_admin', 'AdminController@updateAdmin')->name('update_company_admin');
    Route::get('/delete_company_admin/{id}', 'AdminController@deleteAdmin')->name('delete_company_admin');

    Route::get('/view_products', 'ProductController@view_products')->name('view_products');
    Route::post('/save_product', 'ProductController@store')->name('save_product');
    Route::post('/update_product', 'ProductController@updateProduct')->name('update_product');
    Route::get('/edit_product/{id}', 'ProductController@editProduct')->name('edit_product');
    Route::get('/delete_product/{id}', 'ProductController@deleteProduct')->name('delete_product');


    Route::get('/view_company_outlets', 'OutletController@companyOutlets')->name('view_company_outlets');
    Route::post('/save_outlet', 'OutletController@saveOutlet')->name('save_outlet');
    Route::get('/admin_edit_outlet/{id}', 'OutletController@editOutlet')->name('admin_edit_outlet');
    Route::post('/update_outlet_admin', 'OutletController@updateOutlet')->name('update_outlet_admin');
    Route::get('/admin_delete_outlet/{id}', 'OutletController@deleteOutlet')->name('admin_delete_outlet');

    Route::get('/view_outlet_admins', 'OutletAdminController@viewOutletsAdmins')->name('view_outlet_admins');
    Route::post('/save_outlet_admin', 'OutletAdminController@saveOutletAdmin')->name('save_outlet_admin');
    Route::get('/edit_outlet_admin/{id}', 'OutletAdminController@editOutletAdmin')->name('edit_outlet_admin');
    Route::post('/update_outlet_admin', 'OutletAdminController@updateOutletAdmin')->name('update_outlet_admin');
    Route::get('/delete_outlet_admin', 'OutletAdminController@deleteOutletAdmin')->name('delete_outlet_admin');

    Route::get('/view_promotions', 'PromotionController@viewPromotions')->name('view_promotions');
    Route::post('/save_promotion', 'PromotionController@savePromotion')->name('save_promotion');
    Route::get('/edit_promotion/{id}', 'PromotionController@editPromotion')->name('edit_promotion');
    Route::post('/update_promotion', 'PromotionController@updatePromotion')->name('update_promotion');
    Route::get('/delete_promotion/{id}', 'PromotionController@deletePromotion')->name('delete_promotion');

    Route::get('/view_delivery_price', 'DeliveryPriceController@viewDeliveryPrice')->name('view_delivery_price');
    Route::post('/save_delivery_price', 'DeliveryPriceController@saveDeliveryPrice')->name('save_delivery_price');


});

Route::group(['namespace' => 'OutletAdmin','middleware'=>'auth'],function () {
    //Outlet admin
    Route::get('/view_outlet_products', 'ProductController@viewProducts')->name('view_outlet_products');
    Route::get('/edit_outlet_product/{id}', 'ProductController@editProduct')->name('edit_outlet_product');
    Route::post('/update_outlet_product', 'ProductController@updateProductStatus')->name('update_outlet_product');


    Route::get('/view_operators', 'OperatorController@viewOutletOperators')->name('view_operators');
    Route::post('/save_outlet_operator', 'OperatorController@saveOutletOperator')->name('save_outlet_operator');
    Route::get('/edit_outlet_operator/{id}', 'OperatorController@editOutletOperator')->name('edit_outlet_operator');
    Route::post('/update_outlet_operator', 'OperatorController@updateOutletOperator')->name('update_outlet_operator');
    Route::get('/delete_outlet_operator/{id}', 'OperatorController@deleteOutletOperator')->name('delete_outlet_operator');



    Route::get('/order_placed', 'OrderController@order_placed')->name('order_placed');
    Route::get('/pending_order', 'OrderController@pending_order')->name('pending_order');
    Route::get('/proces_order/{id}', 'OrderController@processOrder')->name('proces_order');
    Route::get('/order_to_be_delivered', 'OrderController@deliveryOrder')->name('order_to_be_delivered');



    Route::get('/outlet_view_sales', 'SalesController@viewSales')->name('outlet_view_sales');

});

Route::group(['namespace' => 'Payments','middleware'=>'auth'],function () {
    Route::get('/check_order_status/{id}', 'CustomerOrderController@checkPayment')->name('check_order_status');
});
Route::group(['namespace' => 'OutletOperator','middleware'=>'auth'],function () {
    Route::get('/view_operator_products', 'ProductController@viewProducts')->name('view_operator_products');
});





