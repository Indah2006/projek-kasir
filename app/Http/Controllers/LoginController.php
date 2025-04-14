<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('pages.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login berhasil!');
        }
        
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}