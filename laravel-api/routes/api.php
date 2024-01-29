<?php

use App\Containers\Controllers\ContainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Order\Controllers\OrderController;
use App\Product\Controllers\ProductTypeController;
use App\Product\Controllers\ProductController;
use App\Product\Controllers\VariantController;
use App\Http\Controllers\AuthController;

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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware("auth:sanctum");


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'auth.sanctum.admin'])->group(function () {
    Route::post('productType',[ProductTypeController::class, 'store']);
    Route::put('productType',[ProductTypeController::class, 'update']);
    Route::delete('productType',[ProductTypeController::class, 'destroy']);

    Route::post('product',[ProductController::class, 'store']);
    Route::put('product',[ProductController::class, 'update']);
    Route::delete('product',[ProductController::class, 'destroy']);

    Route::put('/product/{productId}/activate', [ProductController::class, 'activateProduct'])->name('product.activateProduct');
    Route::put('/product/{productId}/delete', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');

    Route::post('/variant', [VariantController::class, 'store']);

});

Route::get('/product/{productId}/allowedActions', [ProductController::class, 'allowedActions'])->name('product.allowedActions');

Route::get('productType',[ProductTypeController::class, 'index']);
Route::get('productType/{id}',[ProductTypeController::class, 'show']);

Route::get('product/search',[ProductController::class, 'search']);
Route::get('product',[ProductController::class, 'index']);
Route::get('product/{id}',[ProductController::class, 'show']);

Route::apiResource('containers',ContainerController::class);

Route::get('/containers/{id}/allowedActions', [ContainerController::class, 'allowedActions'])->name('container.allowedActions');
Route::put('/containers/{containerId}/changeState/{statusId}', [ContainerController::class, 'changeState'])->name('container.changeState');


Route::apiResource('order',OrderController::class);
Route::put('/order/{orderId}/process', [OrderController::class, 'processOrder'])->name('order.processOrder');
Route::put('/order/{orderId}/approve', [OrderController::class, 'approveOrder'])->name('order.approveOrder');
Route::put('/order/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancelOrder');
Route::put('/order/{orderId}/reject', [OrderController::class, 'rejectOrder'])->name('order.rejectOrder');
Route::get('/order/{orderId}/allowedActions', [OrderController::class, 'allowedActions'])->name('order.allowedActions');
