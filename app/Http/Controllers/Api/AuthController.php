<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau kata sandi salah.',
            ], 401);
        }

        if ($user->role !== 'Petugas') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Aplikasi ini khusus Petugas.',
            ], 403);
        }

        // Sanctum belum tersedia — kembalikan pesan informatif
        return response()->json([
            'success' => false,
            'message' => 'API Token belum tersedia. Gunakan web login di /login.',
        ], 503);
    }

    public function logout(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil logout',
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'data'    => $request->user(),
        ]);
    }
}
