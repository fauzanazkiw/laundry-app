<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\LaporanController;
use App\Http\Controllers\Panel\LayananController;
use App\Http\Controllers\Panel\PelangganController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\StatusLayananController;
use App\Http\Controllers\Panel\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

// Cek status laundry: khusus pelanggan yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('cek-status', [HomeController::class, 'cekStatus']);
    Route::post('lacak', [HomeController::class, 'lacak']);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login');
    Route::post('/loginproses', 'loginproses');
    Route::get('/logout', 'logout');
});

// Pemilik & Karyawan
Route::middleware(['auth', 'role:Pemilik,Karyawan'])->group(function () {
    Route::get('/panel', [DashboardController::class, 'dashboard']);

    // pelanggan
    Route::controller(PelangganController::class)->group(function () {
        Route::get('/panel/pelanggan', 'pelanggan');
        Route::post('/panel/pelanggan-simpan', 'pelanggansimpan');
        Route::get('/panel/pelanggan-edit/{id}', 'pelangganedit');
        Route::put('/panel/pelanggan-update/{id}', 'pelangganupdate');
        Route::delete('/panel/pelanggan-hapus/{id}', 'pelangganhapus');
    });

    // profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/panel/profile', 'profile');
        Route::put('/panel/profile-update', 'profileupdate');
    });
});

// Karyawan saja
Route::middleware(['auth', 'role:Karyawan'])->group(function () {
    // transaksi laundry
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/panel/transaksi', 'transaksi');
        Route::post('/panel/transaksi-simpan', 'transaksisimpan');
        Route::get('/panel/transaksi-detail/{id}', 'transaksidetail');
        Route::put('/panel/transaksi-status/{id}', 'transaksistatus');
        Route::delete('/panel/transaksi-hapus/{id}', 'transaksihapus');
        Route::get('/panel/transaksi-cetak/{id}', 'transaksicetak');
    });
});

// Pemilik saja
Route::middleware(['auth', 'role:Pemilik'])->group(function () {
    // layanan & status per layanan
    Route::controller(LayananController::class)->group(function () {
        Route::get('/panel/layanan', 'layanan');
        Route::post('/panel/layanan-simpan', 'layanansimpan');
        Route::get('/panel/layanan-edit/{id}', 'layananedit');
        Route::put('/panel/layanan-update/{id}', 'layananupdate');
        Route::delete('/panel/layanan-hapus/{id}', 'layananhapus');
    });

    Route::controller(StatusLayananController::class)->group(function () {
        Route::get('/panel/layanan/{layanan_id}/status', 'status');
        Route::post('/panel/status-layanan-simpan/{layanan_id}', 'simpan');
        Route::put('/panel/status-layanan-update/{id}', 'update');
        Route::post('/panel/status-layanan-naik/{id}', 'pindah')->defaults('arah', 'naik');
        Route::post('/panel/status-layanan-turun/{id}', 'pindah')->defaults('arah', 'turun');
        Route::delete('/panel/status-layanan-hapus/{id}', 'hapus');
    });

    // laporan keuangan
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/panel/laporan-keuangan', 'laporan');
        Route::get('/panel/laporan-keuangan-download', 'laporandownload');
    });
});

Route::get('symlink', function () {
    symlink(storage_path('app/public'), public_path('storage'));

    return response()->json(['success' => true]);
});
