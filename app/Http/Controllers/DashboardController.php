<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function showDashboard()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('dashboard');
        }
    }

    public function showBarang()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            $barang = \App\Models\Barang::all();
            return view('admin.barang', compact('barang'));
        }
    }

    public function showKelas()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            $kelas = \App\Models\Kelas::all();
            return view('admin.kelas', compact('kelas'));
        }
    }


    public function showUser()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            $user = \App\Models\User::all();
            return view('admin.user', compact('user'));
        }
    }

    public function showTransaksi()
    {
        $transaksis = \App\Models\Peminjaman::all();
        $now = Carbon::now(); // Dapatkan waktu saat ini, sesuai zona waktu aplikasi Laravel Anda

        foreach ($transaksis as $transaction) {
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

        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('admin.transaksi', compact('transaksis'));
        }
    }
}
