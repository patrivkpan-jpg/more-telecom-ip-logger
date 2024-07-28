<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Middleware\EnsureAccessIsAllowed;
use Illuminate\Support\Facades\Route;


Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('submit', [LoginController::class, 'authenticate'])->name('login.submit');
});

Route::prefix('logout')->group(function () {
    Route::get('/', [LogoutController::class, 'index'])->name('logout');
    Route::post('submit', [LogoutController::class, 'logout'])->name('logout.submit');
});

Route::middleware([EnsureAccessIsAllowed::class])->group(function () {
    Route::get('/', [SampleController::class, 'index'])->name('welcome');
});