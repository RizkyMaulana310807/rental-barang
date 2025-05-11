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
            return view('admin.barang');
        }
    }

    public function showUser()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('admin.user');
        }
    }

    public function showTransaksi()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('admin.transaksi');
        }
    }
}
