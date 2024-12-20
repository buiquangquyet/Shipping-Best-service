<?php

use App\Api\V1\Controllers\OrderController;
use App\Api\V1\Controllers\LoginController;
use App\Api\V1\Controllers\WebhookController;
use App\Http\Middleware\AuthPartner;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/User/Login', [LoginController::class, 'login']);
    Route::post('/webhook', [WebhookController::class, 'webhook']);
    Route::middleware([AuthPartner::class])->group(function () {
        Route::post('/Order/Add', [OrderController::class, 'createOrder']);
        Route::post('/Order/Query', [OrderController::class, 'getOrder']);
        Route::post('/Order/Cancel', [OrderController::class, 'cancelOrder']);
    });
});
