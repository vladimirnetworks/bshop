<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('orders', 'App\Http\Controllers\OrderController');


Route::post('preorder', 'App\Http\Controllers\OrderController@store2');

Route::apiResource('products', 'App\Http\Controllers\ProductController');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('index', 'App\Http\Controllers\ProductController@indexxv');

Route::post('setshipping', 'App\Http\Controllers\OrderController@setshipping');