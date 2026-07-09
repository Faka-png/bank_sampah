<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes Area
Route::middleware(['auth.role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/sampah', [AdminController::class, 'sampahIndex'])->name('admin.sampah');
    Route::post('/sampah', [AdminController::class, 'sampahStore'])->name('admin.sampah.store');
    Route::get('/transaksi', [AdminController::class, 'transaksiIndex'])->name('admin.transaksi');
    Route::get('/transaksi/create', [AdminController::class, 'transaksiCreate'])->name('admin.transaksi.create');
    Route::post('/transaksi', [AdminController::class, 'transaksiStore'])->name('admin.transaksi.store');
    Route::get('/transaksi/{id}', [AdminController::class, 'transaksiDetail'])->name('admin.transaksi.detail');
    Route::get('/warga', [AdminController::class, 'wargaIndex'])->name('admin.warga');
    Route::post('/warga', [AdminController::class, 'wargaStore'])->name('admin.warga.store');
    Route::delete('/admin/warga/delete/{id}', [AdminController::class, 'wargaDelete'])->name('admin.warga.delete');
    Route::delete('/admin/sampah/delete/{id}', [AdminController::class, 'sampahDelete'])->name('admin.sampah.delete');
});

// Warga / Nasabah Routes Area
Route::middleware(['auth.role:pengguna'])->prefix('warga')->group(function () {
    Route::get('/dashboard', [WargaController::class, 'dashboard'])->name('warga.dashboard');
    Route::post('/setor', [WargaController::class, 'setorMandiri'])->name('warga.setor');
});