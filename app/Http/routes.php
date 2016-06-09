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


/*******************cxy**********************/

Route::get('inventory', 'InventoryController@index');
Route::post('inventory', 'InventoryController@post');

Route::get('/', function () {
    return view('welcome');
});

/*********************************************/

Route::get('commodity', function () {
    return view('stockmanage.commodity');
});

Route::get('stock', function () {
    return view('stockmanage.stock');
});

Route::get('receipt', function () {
    return view('stockmanage.receipt');
});

Route::get('test', function () {
    return view('test');
});

Route::get('test2', function () {
    return view('test2');
});