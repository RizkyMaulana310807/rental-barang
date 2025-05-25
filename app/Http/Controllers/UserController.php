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

            \App\Models\User::create([
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
            'email' => 'nullable|email|unique:users,email,' . $id,
            'username' => 'nullable|unique:users,username,' . $id,
            'name' => 'nullable|string|max:255',
            'class_id' => 'nullable|exists:kelas,id',
            'role' => 'nullable|in:user,admin',
            'isGuru' => 'nullable|in:0,1',
            'password' => 'nullable|string',
        ]);

        $data = array_filter($request->only([
            'name',
            'username',
            'email',
            'class_id',
            'role',
            'isGuru'
        ]));

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // Isi $data kosong berarti tidak ada input baru
        if (empty($data)) {
            return redirect()->route('user.edit', $id)
                ->withErrors(['error' => 'Tidak ada data yang diubah']);
        }

        // Fill model dengan data baru
        $user->fill($data);

        // Cek apakah ada perubahan
        if (!$user->isDirty()) {
            return redirect()->route('user.edit', $id)
                ->withErrors(['error' => 'Tidak ada data yang diubah']);
        }

        // Save data jika ada perubahan
        $user->save();

        return redirect()->route('user.edit', $id)->with('success', 'User updated successfully');
    }
}
