<?php

use App\Http\Controllers\SampleController;
use App\Http\Middleware\EnsureIpIsAllowed;
use Illuminate\Support\Facades\Route;


Route::middleware([EnsureIpIsAllowed::class])->group(function () {
    Route::get('/', [SampleController::class, 'index']);
});