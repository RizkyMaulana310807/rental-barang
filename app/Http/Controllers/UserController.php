<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            return view('user.create');
        } else {
            return view('home');
        }
    }

    public function destroy($id)
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {

            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('user')->with('success', 'Barang dan gambar berhasil dihapus.');
        } else {
            return view('home');
        }
    }

    public function store(Request $request)
    {

        if (Auth::check() && trim(Auth::user()->role) == 'admin') {


            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'class' => 'required',
                'role' => 'required',
                'isGuru' => 'required|nullable',
                'password' => 'required'
            ]);

            \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'class' => $request->class,
                'role' => $request->role,
                'isGuru' => $request->isGuru,
                'password' => $request->password,
            ]);

            return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
        } else {
            return view('home');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            return view('user.edit', compact('user')); // tampilkan form edit user
        } else {
            echo "Tidak ada data";
        }
    }
}
