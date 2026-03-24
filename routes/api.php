<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

// Scan endpoints — tanpa CSRF, buat test di bruno
// throttle: max 60 request per menit per IP
Route::middleware('throttle:60,1')->group(function () {
    Route::post('/scan/validate', [AdminController::class, 'scanValidate']);
    Route::post('/scan/revert',   [AdminController::class, 'scanRevert']);
});
