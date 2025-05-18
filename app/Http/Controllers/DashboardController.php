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

    public function showUser()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            $user = \App\Models\User::all();
            return view('admin.user', compact('user'));
        }
    }

    public function showTransaksi()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('admin.transaksi');
        }
    }

}
