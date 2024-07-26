<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\EnsureIpIsAllowed;
use Illuminate\Support\Facades\Route;


Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('submit', [LoginController::class, 'authenticate'])->name('login.submit');
});

Route::middleware([EnsureIpIsAllowed::class])->group(function () {
    Route::get('/', [SampleController::class, 'index'])->name('welcome');
});