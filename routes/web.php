<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/',       fn() => view('welcome'));
Route::get('/galeri', fn() => view('galeri'));

// Tiket & Pesanan (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/tiket',  fn() => view('tiket'));
    Route::post('/tiket', [OrderController::class, 'store']);
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan');
    Route::put('/pesanan/{order}', [OrderController::class, 'update']);
    Route::post('/pesanan/{order}/cancel', [OrderController::class, 'cancel']);
    Route::post('/payment/{order}/pay', [OrderController::class, 'pay'])->name('payment.pay');
    Route::get('/ticket/{order}/download', [OrderController::class, 'downloadPdf'])->name('ticket.download');
});

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                                  [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/transactions',                      [AdminController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{order}',              [AdminController::class, 'transactionDetail'])->name('transactions.detail');
    Route::post('/transactions/{order}/approve',     [AdminController::class, 'approveTransaction'])->name('transactions.approve');
    Route::post('/transactions/{order}/cancel',      [AdminController::class, 'cancelTransaction'])->name('transactions.cancel');
    Route::get('/scan',                              [AdminController::class, 'scanPage'])->name('scan');
    Route::post('/scan/validate',                    [AdminController::class, 'scanValidate'])->name('scan.validate');
    Route::post('/scan/revert',                      [AdminController::class, 'scanRevert'])->name('scan.revert');
    Route::post('/tickets/{ticket}/reset-scan',      [AdminController::class, 'resetTicketScan'])->name('tickets.resetScan');
    Route::get('/sessions',                          [AdminController::class, 'sessions'])->name('sessions');
    Route::post('/sessions',                         [AdminController::class, 'storeSession'])->name('sessions.store');
    Route::put('/sessions/{session}',                [AdminController::class, 'updateSession'])->name('sessions.update');
    Route::delete('/sessions/{session}',             [AdminController::class, 'destroySession'])->name('sessions.destroy');
    Route::get('/reports',                           [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/export',                    [AdminController::class, 'exportCsv'])->name('reports.export');
});

require __DIR__.'/auth.php';
