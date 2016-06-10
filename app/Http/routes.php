<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('commodity', 'CommodityController@index');
Route::post('commodity', 'CommodityController@post');

Route::resource('receipt', 'ReceiptController');
Route::post('receipt/storeitem', 'ReceiptController@storeItem');
Route::get('receipt/createpresent', 'ReceiptController@createPresent');
Route::get('receipt/createoverflow', 'ReceiptController@createOverflow');
Route::get('receipt/createloss', 'ReceiptController@createLoss');
Route::get('receipt/createalert', 'ReceiptController@createAlert');


Route::resource('customer', 'CustomerController');
