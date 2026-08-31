<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

Route::middleware(['auth', 'verified', 'role:admin,staff'])->group(function () {
    Route::resource('barang', BarangController::class);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('legacy.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('legacy.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('legacy.profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
