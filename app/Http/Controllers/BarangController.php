<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $stocks = Barang::select('id', 'nama', 'deskripsi', 'stock')->get();

        return view('home', compact('stocks'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file gambar dari storage
        if (Storage::disk('public')->exists($barang->img_path)) {
            Storage::disk('public')->delete($barang->img_path);
        }

        // Hapus data barang dari database
        $barang->delete();

        return redirect()->route('barang')->with('success', 'Barang dan gambar berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'deskripsi' => 'required',
            'stock' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Simpan gambar ke folder storage/app/public/barang/
        $path = $request->file('gambar')->store('barang', 'public');

        Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stock' => $request->stock,
            'img_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }
}
