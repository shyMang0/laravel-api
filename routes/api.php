<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Product_Ctrl;

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

Route::get('/products',             [Product_Ctrl::class, 'index']);
Route::get('/products/{id}',        [Product_Ctrl::class, 'show']);
Route::get('/products/search/{name}',        [Product_Ctrl::class, 'search']);

Route::POST('/products',            [Product_Ctrl::class, 'store']);
Route::PUT('/products/{id}',        [Product_Ctrl::class, 'update']);
Route::DELETE('/products/{id}',     [Product_Ctrl::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
