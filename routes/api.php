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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::get('list_product', [\App\Http\Controllers\API\ProductController::class, 'list_product']);

Route::middleware('auth.jwt')->group(function () {
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::post('insert_cart', [\App\Http\Controllers\API\CartController::class, 'insert_cart']);
    Route::get('list_cart', [\App\Http\Controllers\API\CartController::class, 'list_cart']);

    Route::post('payment', [\App\Http\Controllers\API\PaymentController::class, 'payment']);
    Route::get('history', [\App\Http\Controllers\API\PaymentController::class, 'history']);
// Route::middleware('sessions')->group(function () {
//     Route::get('products', [\App\Http\Controllers\HomeController::class, 'getProducts']);
//     Route::post('carts', [\App\Http\Controllers\CartController::class, 'store']);
//     Route::get('carts', [\App\Http\Controllers\CartController::class, 'show']);
});