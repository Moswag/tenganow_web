<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/customer_login', 'APIController@customerLogin');
Route::post('/customer_register', 'APIController@customerRegister');
Route::get('/getCompany', 'APIController@getCompanies');
Route::post('/getProducts', 'APIController@getProducts');
Route::post('/placeOrder', 'APIController@placeOrder');
Route::post('/referenceNumber', 'APIController@referenceNumber');
Route::post('/getMyOders', 'APIController@getMyOders');


