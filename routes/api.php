<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\PublicApiController;
use App\Http\Controllers\Api\AdminApiController;

Route::middleware('throttle:60,1')->group(function () {
    // Scan
    Route::post('/scan/validate', [AdminController::class, 'scanValidate']);
    Route::post('/scan/revert',   [AdminController::class, 'scanRevert']);

    // Public info
    Route::get('/ticket/{code}',  [PublicApiController::class, 'ticketStatus']);
    Route::get('/sessions',       [PublicApiController::class, 'sessions']);
});

// Admin API — butuh header X-Api-Secret
Route::middleware(['throttle:60,1', 'api.secret'])->prefix('admin')->group(function () {
    Route::get('/users',                  [AdminApiController::class, 'users']);
    Route::get('/orders',                 [AdminApiController::class, 'orders']);
    Route::delete('/sessions/{session}',  [AdminApiController::class, 'deleteSession']);
    Route::delete('/orders/{order}',      [AdminApiController::class, 'deleteOrder']);
});
