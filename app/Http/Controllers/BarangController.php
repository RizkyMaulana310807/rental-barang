<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function create()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            return view('barang.create');
        } else {
            return view('home');
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $barang = Barang::findOrFail($id);

            // Hapus file gambar dari storage
            if (Storage::disk('public')->exists($barang->img_path)) {
                Storage::disk('public')->delete($barang->img_path);
            }

            // Hapus data barang dari database
            $barang->delete();

            return redirect()->route('barang')->with('success', 'Barang dan gambar berhasil dihapus.');
        } else {
            return view('home');
        }
    }

    public function store(Request $request)
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

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
        } else {
            return view('home');
        }
    }

    public function edit($id)
    {
        $barang = Barang::find($id);

        if ($barang) {
            return view('barang.edit', compact('barang'));
        } else {
            abort(404, 'barang tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
            'stock' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png|max:5120', // max 5MB
        ]);

        // Cek apakah ada perubahan data
        $hasChanges = false;

        if (
            $barang->nama !== $request->nama ||
            $barang->deskripsi !== $request->deskripsi ||
            $barang->stock != $request->stock ||
            $request->hasFile('gambar')
        ) {
            $hasChanges = true;
        }

        if (!$hasChanges) {
            return redirect()->route('barang.edit', ['id' => $id])
                ->withErrors(['error' => 'Tidak ada data yang diubah.']);
        }

        // Update data barang
        $barang->nama = $request->nama;
        $barang->deskripsi = $request->deskripsi;
        $barang->stock = $request->stock;

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->img_path && Storage::disk('public')->exists($barang->img_path)) {
                Storage::disk('public')->delete($barang->img_path);
            }

            // Upload gambar baru
            $image = $request->file('gambar');
            $imageName = time() . '_' . $barang->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('barang', $imageName, 'public');

            $barang->img_path = $imagePath;
        }

        $barang->save();

        return redirect()->route('barang.edit', ['id' => $id])
            ->with('success', "Barang {$request->nama} berhasil diupdate.");
    }
}
