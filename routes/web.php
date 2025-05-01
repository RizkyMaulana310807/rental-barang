<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\BarangController;


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
