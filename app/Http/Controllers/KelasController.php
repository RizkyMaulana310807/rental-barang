<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function create()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            return view('/kelas/create');
        }
    }

    public function store(Request $Request)
    {
        $Request->validate([
            'name' => 'required',
        ]);


        Kelas::create([
            'nama_kelas' => $Request->name,
        ]);

        return redirect()->route('kelas.create')->with('success', "Kelas $Request->name berhasil di tambahkan.");
    }

    public function destroy($id)
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $kelas = Kelas::findOrFail($id);

            $kelas->delete();

            return redirect()->route('kelas')->with('success', "Kelas $kelas->nama_kelas berhasil dihapus.");
        } else {
            return view('home');
        }
    }
    public function edit($id)
    {
        $kelas = Kelas::find($id);

        if ($kelas) {
            return view('kelas.edit', compact('kelas'));
        } else {
            abort(404, 'Kelas tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
    
        $request->validate([
            'kelas' => 'required|string|max:255',
        ]);
    
        // Cek apakah data yang dimasukkan sama dengan data sebelumnya
        if ($kelas->nama_kelas === $request->kelas) {
            return redirect()->route('kelas.edit', ['id' => $id])
                ->withErrors(['error' => 'Tidak ada data yang diubah.']);
        }
    
        $kelas->nama_kelas = $request->kelas;
        $kelas->save();
    
        return redirect()->route('kelas.edit', ['id' => $id])
            ->with('success', "Kelas {$request->kelas} berhasil diupdate.");
    }
    }
