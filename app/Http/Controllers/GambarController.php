<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gambar;

class GambarController extends Controller
{
    public function uploadForm()
    {
        return view('gambar.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $path = $request->file('gambar')->store('gambar', 'public');

        Gambar::create([
            'nama' => $request->nama,
            'path' => $path,
        ]);

        return redirect()->route('gambar.index')->with('success', 'Gambar berhasil diupload!');
    }

    public function index()
    {
        $data = Gambar::latest()->get();
        return view('gambar.index', compact('data'));
    }
}
