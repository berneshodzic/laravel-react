<?php

use App\Containers\Controllers\ContainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
