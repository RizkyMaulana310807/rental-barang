<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after_or_equal:jam_mulai',
        ]);

        // Cek stok barang
        $barang = Barang::findOrFail($request->barang_id);
        if ($barang->stock <= 0) {
            return back()->withErrors(['barang_id' => 'Stok barang tidak mencukupi.'])->withInput();
        }

        // Simpan peminjaman
        Peminjaman::create([
            'id_user' => Auth::user()->id,
            'id_barang' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'pending', // Atau sesuai logikamu
        ]);

        // Kurangi stok barang
        $barang->decrement('stock');

        return redirect()->route('home')->with('success', 'Peminjaman berhasil diajukan!');
    }

    public function create(Barang $barang)
    {
        return view('formTransaksi', ['barang' => $barang]);
    }

    public function edit($id){
        
    }
}
