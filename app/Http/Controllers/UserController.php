<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;

class UserController extends Controller
{

    public function create()
    {
        if (Auth::check() && trim(Auth::user()->role) == 'admin') {
            $kelas = Kelas::all();
            return view('user.create', compact('kelas'));
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
                'username' => 'required',
                'email' => 'required|unique:users|email',
                'class_id' => 'required',
                'role' => 'required|nullable',
                'isGuru' => 'required|nullable',
                'password' => 'required'
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'class_id' => $request->class_id,
                'role' => $request->role,
                'isGuru' => $request->isGuru,
                'password' => $request->password,
            ]);

            return redirect()->back()->with('success', 'User berhasil di tambahkan!');
        } else {
            return view('home');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $kelas = Kelas::all();

        if ($user) {
            return view('user.edit', compact('user', 'kelas')); // tampilkan form edit user
        } else {
            echo "Tidak ada data";
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:kelas,id',
            'role' => 'required|in:user,admin',
            'isGuru' => 'required|in:0,1',
            'password' => 'nullable|string',
        ]);

        // Update data user
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->class_id = $request->class_id;
        $user->role = $request->role;
        $user->isGuru = $request->isGuru;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Cek apakah ada perubahan
        if (!$user->isDirty()) {
            return redirect()->route('user.edit', $id)
                ->withErrors(['error' => 'Tidak ada data yang diubah']);
        }

        $user->save();

        return redirect()->route('user.edit', $id)
            ->with('success', 'User updated successfully');
    }
}
