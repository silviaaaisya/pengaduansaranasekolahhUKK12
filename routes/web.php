<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;

// --- LOGIN & REGISTER ---
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/register-admin', [AuthController::class, 'registerAdmin']);
Route::post('/register-admin', [AuthController::class, 'storeRegisterAdmin']);

// Pastikan ditaruh di dalam Route::middleware('auth:siswa')->group(...)
Route::get('/siswa/dashboard', [AspirasiController::class, 'dashboardSiswa']);
Route::post('/siswa/aspirasi', [AspirasiController::class, 'store']);

// TAMBAHKAN BARIS INI
Route::get('/siswa/histori', [AspirasiController::class, 'histori']);

// --- FITUR ADMIN ---
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::post('/admin/aspirasi/update/{id}', [AdminController::class, 'updateStatus']);
    
    // Rute Data Siswa
    Route::get('/admin/siswa', [AdminController::class, 'siswa']);
    Route::post('/admin/siswa', [AdminController::class, 'storeSiswa']);
    Route::delete('/admin/siswa/{nis}', [AdminController::class, 'destroySiswa']);

    // Tambahkan di dalam Route::middleware('auth:admin')->group(...)
Route::get('/admin/kategori', [AdminController::class, 'kategori']);
Route::post('/admin/kategori', [AdminController::class, 'storeKategori']);
Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroyKategori']);

// Route untuk testing suntik data kategori
Route::get('/buat-kategori-test', function () {
    \App\Models\Kategori::create(['ket_kategori' => 'Kebersihan Lingkungan']);
    \App\Models\Kategori::create(['ket_kategori' => 'Fasilitas Kelas & Lab']);
    \App\Models\Kategori::create(['ket_kategori' => 'Alat Olahraga']);
    
    return "SUKSES! 3 Kategori berhasil dimasukkan ke database. Silakan kembali ke dashboard siswa.";
});
});