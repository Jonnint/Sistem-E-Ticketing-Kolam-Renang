<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\PublicApiController;

Route::middleware('throttle:60,1')->group(function () {
    // Scan
    Route::post('/scan/validate', [AdminController::class, 'scanValidate']);
    Route::post('/scan/revert',   [AdminController::class, 'scanRevert']);

    // Public info
    Route::get('/ticket/{code}',  [PublicApiController::class, 'ticketStatus']);
    Route::get('/sessions',       [PublicApiController::class, 'sessions']);
});
