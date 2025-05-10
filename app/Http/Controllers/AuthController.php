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

    public function register(Request $request) {
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'kelas' => 'required',
            'email' => 'required', 
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->nama,
            // 'username' => $request->username,
            // 'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('/');
        
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    
}
