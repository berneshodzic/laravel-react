<?php

use App\Containers\Controllers\ContainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Order\Controllers\OrderController;

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

Route::apiResource('containers',ContainerController::class);

Route::get('/containers/{id}/allowedActions', [ContainerController::class, 'allowedActions'])->name('container.allowedActions');
Route::put('/containers/{containerId}/changeState/{statusId}', [ContainerController::class, 'changeState'])->name('container.changeState');


Route::apiResource('order',OrderController::class);
Route::put('/order/{orderId}/process', [OrderController::class, 'processOrder'])->name('order.processOrder');
Route::put('/order/{orderId}/approve', [OrderController::class, 'approveOrder'])->name('order.approveOrder');
Route::put('/order/{orderId}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancelOrder');
Route::put('/order/{orderId}/reject', [OrderController::class, 'rejectOrder'])->name('order.rejectOrder');
Route::get('/order/{orderId}/allowedActions', [OrderController::class, 'allowedActions'])->name('order.allowedActions');

