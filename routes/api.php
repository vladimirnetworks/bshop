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
Route::apiResource('fastprice', 'App\Http\Controllers\fastprice');
#Route::apiResource('categories', 'App\Http\Controllers\CatController');

Route::get('categories/{parentid}', 'App\Http\Controllers\CatController@index');
Route::post('categories/{parentid}', 'App\Http\Controllers\CatController@store');
Route::put('categories/{parentid}/{Cat}', 'App\Http\Controllers\CatController@update');
Route::delete('categories/{parentid}/{Cat}', 'App\Http\Controllers\CatController@destroy');







Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('index', 'App\Http\Controllers\ProductController@indexxv');
Route::get('fromcat/{catid}', 'App\Http\Controllers\ProductController@indecat');
Route::get('relateto/{prodid}', 'App\Http\Controllers\ProductController@relateto');
Route::get('maincat', 'App\Http\Controllers\CatController@maincat');

Route::post('search', 'App\Http\Controllers\SearchController@search');


Route::post('catload', 'App\Http\Controllers\CatController@catload');





Route::get('onelevelchild/{rootid}', 'App\Http\Controllers\CatController@oneLevelChild');

Route::post('setshipping', 'App\Http\Controllers\OrderController@setshipping');

Route::post('reguserdata', 'App\Http\Controllers\UserdataController@setuserdata');