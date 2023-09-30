<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CopounController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OutOrderController;
use App\Http\Controllers\Api\OrderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth'])->group(function () {
    Route::post('/apply-coupon', [CopounController::class, 'applyCoupon']);
    Route::put('/remove-coupon', [CopounController::class, 'removeCoupon']);
});
Route::get('/banners', [BannerController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);

Route::middleware(['auth'])->group(function () {
Route::post('/out-orders', [OutOrderController::class, 'store']);
Route::get('/out-orders/{outOrder}', [OutOrderController::class, 'show']);
Route::put('/out-orders/{outOrder}', [OutOrderController::class, 'update']);
Route::post('/orders', [OrderController::class, 'store']);
});