<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;
use App\Api\V1\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/api/v1')->group(function () {
    Route::get('index', [TestController::class, 'index']);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
});

require __DIR__.'/auth.php';
