<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // ============================================================
    // REGISTER (Khusus Warga)
    // ============================================================
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'nama_lengkap' => $request->name, // Disesuaikan dengan model User
            'email'        => $request->email,
            'password'     => \Hash::make($request->password),
            'role'         => 'Warga',
        ]);

        \Auth::login($user);

        return redirect()->route('masyarakat.dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang di SAMPAY.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Redirect user berdasarkan role-nya.
     */
    private function redirectByRole($user)
    {
        return match ($user->role) {
            'Admin Pusat' => redirect()->route('admin.dashboard'),
            'Petugas'     => redirect()->route('petugas.dashboard'),
            'Warga'       => redirect()->route('masyarakat.dashboard'),
            default       => redirect()->route('login'),
        };
    }
}
