<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('layout.login'); // login.blade.php
    }

    public function login(Request $request)
    {
        $akun = Akun::where('email', $request->email)->first();

        if ($akun && Hash::check($request->password, $akun->password)) {
            session(['user' => $akun->id]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (!session('user')) {
            return redirect()->route('login');
        }

        return view('layout.dashboard');
    }
}

