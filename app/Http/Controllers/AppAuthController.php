<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role === 'Petugas') return redirect()->route('petugas.dashboard');
            if ($role === 'Masyarakat') return redirect()->route('masyarakat.dashboard');
            if ($role === 'Admin Pusat') return redirect()->route('admin.dashboard');
        }

        return view('pages.app_auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Cek role untuk menentukan arah redirect
            if ($user->role === 'Admin Pusat') {
                Auth::logout();
                return back()->withErrors(['email' => 'Silakan login melalui portal Admin.'])->withInput();
            }

            $request->session()->regenerate();

            if ($user->role === 'Petugas') {
                return redirect()->route('petugas.dashboard');
            } elseif ($user->role === 'Masyarakat') {
                return redirect()->route('masyarakat.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('app.login');
    }
}
