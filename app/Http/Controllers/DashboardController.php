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
}
