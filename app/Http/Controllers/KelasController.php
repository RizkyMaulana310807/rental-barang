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

        return view('home');
    }

    public function destroy($id)
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $kelas = Kelas::findOrFail($id);

            $kelas->delete();
            
            return redirect()->route('barang')->with('success', 'Barang dan gambar berhasil dihapus.');
        } else {
            return view('home');
        }
    }
}
