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
Route::group(['middleware' => 'api', 'prefix' => 'v1'], function() {
    Route::group(['prefix' => 'payment'], function() {
        Route::post('/initiate', "Api\\Payments\\PaynowController@initExpress");
        Route::post('/poll', "Api\\Payments\\PaynowController@pollTransaction");
    });


});

Route::post('/customer_login', 'APIController@customerLogin');
Route::post('/customer_register', 'APIController@customerRegister');
Route::get('/getCompany', 'APIController@getCompanies');
Route::post('/getOutlets', 'APIController@getOutlets');
Route::post('/getProducts', 'APIController@getProducts');
Route::post('/placeOrder', 'APIController@placeOrder');
Route::post('/referenceNumber', 'APIController@referenceNumber');
Route::post('/getMyOders', 'APIController@getMyOders');


