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


Route::get('/product/{product}', "App\Http\Controllers\ProductController@show")->middleware('tokin');


Route::get('/contact-us', function() {
    return view("contactus",["pageTitle"=>"تماس با ما"]);
})->middleware('tokin');