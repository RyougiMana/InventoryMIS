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

Route::get('purchaseitem/create/{id}', 'PurchaseItemController@create');
Route::post('purchaseitem/create/{id}', 'PurchaseItemController@store');

Route::get('purchaseback/listreceipt/{id}', 'PurchaseBackReceiptController@showPurchase');
Route::post('purchaseback/create/{id}', 'PurchaseBackReceiptController@store');

Route::get('saleitem/create/{id}', 'SaleItemController@create');
Route::post('saleitem/create/{id}', 'SaleItemController@store');

Route::get('saleback/listreceipt/{id}', 'SaleBackReceiptController@showSale');
Route::post('saleback/create/{id}', 'SaleBackReceiptController@store');

Route::resource('purchase', 'PurchaseReceiptController');
Route::resource('purchaseback', 'PurchaseBackReceiptController');
Route::resource('sale', 'SaleReceiptController');
Route::resource('saleback', 'SaleBackReceiptController');

Route::get('stock', 'StockController@index');
Route::get('stock/{id}', 'StockController@show');
Route::post('stock/create', 'StockController@store');

/* mis */
Route::get('miscommoditydisplay', 'MisCommodityController@display');
Route::get('miscommoditytendency/commodity/{id}', 'MisCommodityController@commodityTendency');
Route::get('miscommoditytendency/classification/{id}', 'MisCommodityController@classificationTendency');
Route::get('miscommoditytendency', 'MisCommodityController@tendency');

/* get information */
Route::get('miscommodity/info/commodity/{id}', 'MisCommodityController@getCommodityInfo');
Route::get('miscommodity/info/commodity/y/{id}', 'MisCommodityController@getCommodityInfoYear');
Route::get('miscommodity/info/commodity/m/{id}', 'MisCommodityController@getCommodityInfoMonth');
Route::get('miscommodity/info/commodity/d/{id}', 'MisCommodityController@getCommodityInfoDay');

Route::get('miscommodity/info/classification/{id}', 'MisCommodityController@getClassificationInfo');
