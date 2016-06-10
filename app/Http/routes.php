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

Route::get('receipt', 'ReceiptController@index');
Route::get('receipt/create', 'ReceiptController@create');
Route::post('receipt/create', 'ReceiptController@store');
Route::post('receipt/pending', 'ReceiptController@pending');
Route::get('receipt/edit', 'ReceiptController@edit');
Route::post('receipt/create', 'ReceiptController@update');

Route::get('/', function () {
    return view('welcome');
});

