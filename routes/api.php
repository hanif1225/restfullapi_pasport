<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Product2Controller;

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

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {

Route::resource('products', ProductController::class);
Route::get('products/{uuid}', 'ProductController@show');
Route::post('products/{uuid}', 'ProductController@update');
// Route::GET('products',[ProductController::class,'index']);
// Route::GET('index_produk',[ProductController::class,'index']);
// Route::POST('store_produk',[ProductController::class,'store']);
Route::POST('logout',[PassportAuthController::class,'logout']);

});