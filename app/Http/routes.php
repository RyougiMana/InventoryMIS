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
Route::get('miscommoditydisplay', 'MisCommodityDisplayController@display');
Route::get('miscommoditytendency', 'MisCommodityTendencyController@tendency');

/* get information */
Route::get('miscommodity/info/commodity/{id}', 'MisCommodityDisplayController@getCommodityInfo');

Route::get('miscommodity/info/commodity/sale/y/{id}', 'MisCommodityDisplayController@getCommoditySaleInfoYear');
Route::get('miscommodity/info/commodity/sale/m/{id}', 'MisCommodityDisplayController@getCommoditySaleInfoMonth');
Route::get('miscommodity/info/commodity/sale/d/{id}', 'MisCommodityDisplayController@getCommoditySaleInfoDay');

Route::get('miscommodity/info/commodity/purchase/y/{id}', 'MisCommodityDisplayController@getCommodityPurchaseInfoYear');
Route::get('miscommodity/info/commodity/purchase/m/{id}', 'MisCommodityDisplayController@getCommodityPurchaseInfoMonth');
Route::get('miscommodity/info/commodity/purchase/d/{id}', 'MisCommodityDisplayController@getCommodityPurchaseInfoDay');

/* get tendency view */
Route::get('miscommodity/tendency/commodity/y/{id}', 'MisCommodityDisplayController@getCommodityTendencyYear');
Route::get('miscommodity/tendency/commodity/m/{id}', 'MisCommodityDisplayController@getCommodityTendencyMonth');
Route::get('miscommodity/tendency/commodity/d/{id}', 'MisCommodityDisplayController@getCommodityTendencyDay');

/* get purchase plan view */
Route::get('miscommodity/purchaseplan/{id}', 'MisCommodityTendencyController@showPurchasePlan');
/* get sale plan view */
Route::get('miscommodity/saleplan/{id}', 'MisCommodityTendencyController@showSalePlan');
/* get star view */
Route::get('miscommodity/star/{id}', 'MisCommodityTendencyController@showStar');


/* lately defined demands */
Route::get('mis/commodity/comparison', 'MisCommodityComparisonController@index');
Route::get('mis/commodity/comparison/make/{idArray}', 'MisCommodityComparisonController@makeComparison');