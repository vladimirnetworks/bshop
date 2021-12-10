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

//Route::apiResource('orders', 'App\Http\Controllers\OrderController');
Route::post('preorder', 'App\Http\Controllers\OrderController@preorder');

Route::apiResource('products', 'App\Http\Controllers\ProductController');
Route::apiResource('fastprice', 'App\Http\Controllers\fastprice');

Route::get('admin/orders', 'App\Http\Controllers\OrderController@allorders');
Route::put('admin/orders/{order}', 'App\Http\Controllers\OrderController@changeorder');
Route::get('admin/latestusers', 'App\Http\Controllers\monitorController@LatestUsers');



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


Route::get('setbaseaddress', function(Request $request) {



  if ($request->baseaddress == 'admin' && $request->xaddress == '1234') {
      
  }

});
