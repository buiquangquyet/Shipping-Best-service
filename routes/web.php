<?php

use Illuminate\Support\Facades\Route;
use App\Api\V1\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/api/v1')->group(function () {
    Route::get('index', [TestController::class, 'index']);
});
