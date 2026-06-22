<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisBarangController;
use App\Http\Controllers\BarangHibahController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\PeminjamanBarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// ----- Auth -----
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----- Area yang butuh login -----
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('inventaris', InventarisBarangController::class)
        ->parameters(['inventaris' => 'inventaris']);

    Route::resource('barang-hibah', BarangHibahController::class);
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::resource('peminjaman', PeminjamanBarangController::class);
});