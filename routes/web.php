<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', "App\Http\Controllers\mainPageController@index")->middleware('tokin');

Route::get('/cat/{cat}', "App\Http\Controllers\mainPageController@index")->middleware('tokin');

Route::get('/myorders', "App\Http\Controllers\OrderController@index")->middleware('tokin');

Route::get('/myorders/{orderid}', "App\Http\Controllers\OrderController@showorder")->middleware('tokin');

Route::get('/product/{product}', "App\Http\Controllers\ProductController@show")->middleware('tokin');


Route::get('/onlinepayment/{orderid}', "App\Http\Controllers\OrderController@onlinepayment")->middleware('tokin');







Route::get('/200297.txt',function() {
    return "";
});











Route::get('/onlinepay/{orderid}', "App\Http\Controllers\OrderController@onlinepay")->middleware('tokin');



Route::get('/zainpalverify/{paymentid}', "App\Http\Controllers\Paymentvarify@zarinpal")->middleware('tokin');



Route::get('/testben', function() {
    return "321";
});


Route::get('/notif654', function() {
    return view("notif",["pageTitle"=>"notif"]);
});

Route::get('/notif2', function() {
    return view("notif2",["pageTitle"=>"notif"]);
});