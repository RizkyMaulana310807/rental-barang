<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stocks = Barang::all(); // Ambil semua data dari tabel 'barang'

    return view('home', compact('stocks'));
});
