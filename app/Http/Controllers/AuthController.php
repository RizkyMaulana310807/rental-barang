<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'kelas' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'class' => $request->kelas,
            'password' => $request->password,
        ]);

        return redirect('/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
