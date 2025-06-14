<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;


use App\Models\Barang;
use App\Models\Peminjaman;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ExportController;


Route::get('/', function () {
    $stocks = Barang::all();
    return view('home', compact('stocks'));
})->name('home');

Route::get('/error/503', function(){
    return view('error/503');
})->name('503');

Route::get('/error/500', function(){
    return view('error/500');
})->name('500');

Route::get('/error/404', function(){
    return view('error/404');
})->name('404');

Route::get('/pinjam/form', function(){
    $barang = Barang::all();
    return view('formTransaksi', compact('barang'));
})->name('formTransaksi');


Route::get('/profile', function(){
    return view('profile');
})->name('profile');



Route::get('/dipinjam', function () {
    $transactions = Peminjaman::with('barang')
        ->where('id_user', Auth::id())
        ->get();

    $now = Carbon::now(); // Dapatkan waktu saat ini, sesuai zona waktu aplikasi Laravel Anda

    foreach ($transactions as $transaction) {
        // Pastikan kedua kolom tidak null sebelum memproses
        if ($transaction->tanggal_kembali && $transaction->jam_selesai) {
            // Gabungkan tanggal dan jam menjadi satu string waktu lengkap
            $dateTimeString = $transaction->tanggal_kembali . ' ' . $transaction->jam_selesai;
            $returnDateTime = Carbon::parse($dateTimeString);

            if ($returnDateTime->lt($now) && !$transaction->jam_dikembalikan) { // 'lt' stands for less than (lebih kecil dari)
                // Lakukan update status di kolom tertentu
                // Contoh: Mengupdate kolom 'status_peminjaman' menjadi 'terlambat'
                $transaction->status = 'terlambat'; // Ganti dengan nama kolom dan nilai status yang sesuai
                $transaction->save(); // Simpan perubahan ke database
            }
        }
    }

    return view('dipinjam', compact('transactions'));
})->name('dipinjam');

Route::put('/peminjaman/{id}/return', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.return');


Route::get('/peminjaman/create/{barang}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::get('/peminjaman/create', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::delete('/pinjam/{barang}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
Route::get('/pinjam/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}/update', [PeminjamanController::class, 'update'])->name('peminjaman.update');


Route::get('/gambar/upload', [GambarController::class, 'uploadForm'])->name('gambar.uploadForm');
Route::post('/gambar/upload', [GambarController::class, 'store'])->name('gambar.store');
Route::get('/gambar/daftar', [GambarController::class, 'index'])->name('gambar.index');

Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');

Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
Route::put('/kelas/{id}/update', [KelasController::class, 'update'])->name('kelas.update');


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
// Route::get('/Dashboard/user/{id}/edit', [DashboardController::class, 'editUser'])->name('editUser');


// --===-- Export Data --===--
Route::get('/export-users', [ExportController::class, 'ExportUser']);
Route::get('/export-barang', [ExportController::class, 'ExportBarang']);
Route::get('/export-kelas', [ExportController::class, 'ExportKelas']);
Route::get('/export-transaksi', [ExportController::class, 'ExportTransaksi']);
