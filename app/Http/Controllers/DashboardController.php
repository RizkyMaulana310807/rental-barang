<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('admin.transaksi', compact('transaksis'));
        }
    }
}
