<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index() {
        $stocks = Barang::select('id', 'nama', 'deskripsi', 'stock')->get();

        return view('home', compact('stocks'));
    
    }
}
