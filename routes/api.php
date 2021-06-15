<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth_Ctrl;
use App\Http\Controllers\Product_Ctrl;
use App\Http\Controllers\SMS_Ctrl;

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


Route::POST('/register',                    [Auth_Ctrl::class, 'register']);
Route::POST('/login',                       [Auth_Ctrl::class, 'login']);

Route::get('/products',                     [Product_Ctrl::class, 'index']);
Route::get('/products/{id}',                [Product_Ctrl::class, 'show']);
Route::get('/products/search/{name}',       [Product_Ctrl::class, 'search']);
 

Route::group(['prefix' => 'sms'], function () { 
    Route::get('/',                     [SMS_Ctrl::class, 'index']);
    Route::get('/sendtest',             [SMS_Ctrl::class, 'index']);
    Route::POST('/sendtest',            [SMS_Ctrl::class, 'send_test_sms']);

    Route::get('/localtokite',          [SMS_Ctrl::class, 'localtokite']);
});

Route::group(['middleware' => ['auth:sanctum']], function() { 
     
    Route::get('/user',                 [Auth_Ctrl::class, 'info']);

    Route::POST('/products',            [Product_Ctrl::class, 'store']);
    Route::PUT('/products/{id}',        [Product_Ctrl::class, 'update']);
    Route::DELETE('/products/{id}',     [Product_Ctrl::class, 'destroy']);
    Route::POST('/logout',              [Auth_Ctrl::class, 'logout']);

}); 


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
