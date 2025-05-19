<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;

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

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/Dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::get('/Dashboard/barang', [DashboardController::class, 'showBarang'])->name('barang');
Route::get('/Dashboard/user', [DashboardController::class, 'showUser'])->name('user');
Route::get('/Dashboard/transaksi', [DashboardController::class, 'showTransaksi'])->name('transaksi');
Route::get('/Dashboard/kelas', [DashboardController::class, 'showKelas'])->name('kelas');
Route::get('/Dashboard/user/{id}/edit', [DashboardController::class, 'editUser'])->name('editUser');
