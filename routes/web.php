<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $stocks = Barang::all(); // Ambil semua data dari tabel 'barang'

    return view('home', compact('stocks'));
})->name('home');

Route::get('/gambar/upload', [GambarController::class, 'uploadForm'])->name('gambar.uploadForm');
Route::post('/gambar/upload', [GambarController::class, 'store'])->name('gambar.store');
Route::get('/gambar/daftar', [GambarController::class, 'index'])->name('gambar.index');

Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/Dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/Dashboard', [DashboardController::class, 'showBarang'])->name('barang');
Route::get('/Dashboard', [DashboardController::class, 'showUser'])->name('user');
Route::get('/Dashboard', [DashboardController::class, 'showTransaksi'])->name('transaksi');
