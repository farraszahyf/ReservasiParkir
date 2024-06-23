<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ParkirController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/home.', [ParkirController::class, 'Landing'])->name('landing.page');
Route::get('/qr-code/{product_code}', [ParkirController::class, 'showQRCode'])->name('qr_code.show');

Route::get('/reservasiparkir', [ParkirController::class, 'create'])->name('parkir.create');
Route::post('/reservasiparkir', [ParkirController::class, 'store'])->name('parkir.store');

Auth::routes();

Route::get('/admin', [ParkirController::class, 'index'])->name('admin');
Route::get('/admin', [ParkirController::class, 'show'])->name('parkir.show');
Route::delete('/admin/{id}', [ParkirController::class, 'destroy'])->name('delete');

