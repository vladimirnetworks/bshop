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


Route::get('/onlinepayment/{orderid}', "App\Http\Controllers\OrderController@onlinepayment")->middleware('tokin');



Route::get('/admin',function() {
    return redirect('https://angular-ivy-vowr18.stackblitz.io/');
});



Route::get('/200297.txt',function() {
    return "";
});


Route::get('/login', "App\Http\Controllers\Logincontroller@login")->middleware('tokin');
Route::post('/login', "App\Http\Controllers\Logincontroller@login2")->middleware('tokin');



Route::get('/contact-us', function() {
    return view("contactus",["pageTitle"=>"تماس با ما"]);
})->middleware('tokin');




Route::get('/index2', "App\Http\Controllers\mainPageController@index2")->middleware('tokin');

Route::get('/index3', "App\Http\Controllers\mainPageController@index3")->middleware('tokin');


Route::get('/onlinepay/{orderid}', "App\Http\Controllers\OrderController@onlinepay")->middleware('tokin');