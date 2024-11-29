<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\CreditController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PerawatanController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\JenisBarangController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\User\PeminjamanController as PeminjamanUser;
use App\Http\Controllers\User\PengembalianController as PengembalianUser;


Route::prefix('/')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/password', [AuthController::class, 'password'])->name('password');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
    Route::post('/password', [AuthController::class, 'passwordValidation'])->name('password.validation');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/options', [OptionsController::class, 'index'])->name('options');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('credit')->group(function () {
    Route::get('/', [CreditController::class, 'index'])->name('credit.index');
    Route::get('/edit/{uuid}', [CreditController::class, 'edit'])->name('credit.edit');
    Route::get('/{uuid}/guidebook', [CreditController::class, 'guidebook'])->name('credit.guidebook');
    Route::put('/update/{uuid}', [CreditController::class, 'update'])->name('credit.update');
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/tambah', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/edit/{uuid}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::get('/detail/{uuid}', [BarangController::class, 'show'])->name('barang.show');
    Route::put('/update/{uuid}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/destroy/{uuid}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::put('reset-limit/{uuid}', [BarangController::class, 'resetLimit'])->name('barang.reset-limit');
    Route::get('/print-barang', [BarangController::class, 'printBarang'])->name('barang.print-barang');
    Route::get('/print-qrcode', [BarangController::class, 'printQrCode'])->name('barang.print-qrcode');
    Route::get('/result', [BarangController::class, 'search'])->name('barang.search');
    Route::get('jenis-barang/{jenisBarang:uuid}', [BarangController::class, 'jenisBarang'])->name('barang.jenis-barang');
});

Route::prefix('jenis-barang')->group(function () {
    Route::get('/', [JenisBarangController::class, 'index'])->name('jenis-barang.index');
    Route::post('/store', [JenisBarangController::class, 'store'])->name('jenis-barang.store');
    Route::get('/edit/{uuid}', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit');
    Route::put('/update/{uuid}', [JenisBarangController::class, 'update'])->name('jenis-barang.update');
    Route::delete('/destroy/{uuid}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy');
});

Route::prefix('perawatan')->group(function () {
    Route::get('/', [PerawatanController::class, 'barangTidakTersedia'])->name('perawatan.index');
    // Route::get('/tambah', [PerawatanController::class, 'create'])->name('perawatan.create');
    // Route::post('/store', [PerawatanController::class, 'store'])->name('perawatan.store');
    // Route::get('/barang', [PerawatanController::class, 'barangTidakTersedia'])->name('perawatan.barang');
    Route::get('/barang/detail/{uuid}', [PerawatanController::class, 'detailBarang'])->name('perawatan.barang.detail');
    Route::put('reset-limit/{uuid}', [PerawatanController::class, 'resetLimit'])->name('perawatan.reset-limit');
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});



Route::get('/user/options', [OptionsController::class, 'index'])->name('user.options');

Route::prefix('user/peminjaman')->group(function () {
    Route::get('/', [PeminjamanUser::class, 'index'])->name('user.peminjaman.index');
    Route::post('/scan', [PeminjamanUser::class, 'scan'])->name('user.peminjaman.scan');
    Route::delete('/remove/{uuid}', [PeminjamanUser::class, 'removeItem'])->name('user.peminjaman.remove');
    Route::post('/store', [PeminjamanUser::class, 'store'])->name('user.peminjaman.store');
    Route::get('/report', [PeminjamanUser::class, 'report'])->name('user.peminjaman.report');
    Route::get('/pdf', [PeminjamanUser::class, 'printReport'])->name('user.peminjaman.pdf');
});

Route::prefix('user/pengembalian')->group(function () {
    Route::get('/', [PengembalianUser::class, 'index'])->name('user.pengembalian.index');
    Route::post('/check', [PengembalianUser::class, 'checkPeminjaman'])->name('user.pengembalian.check');
    Route::post('/validation', [PengembalianUser::class, 'validateItem'])->name('user.pengembalian.validate');
    Route::post('/store', [PengembalianUser::class, 'store'])->name('user.pengembalian.store');
    Route::get('/report', [PengembalianUser::class, 'report'])->name('user.pengembalian.report');
    Route::put('/update_desc', [PengembalianUser::class, 'desc_update'])->name('user.pengembalian.update_desc');
//    route::get('/pdf', [PengembalianUser::class, 'printReport'])->name('user.pengembalian.pdf');
});
