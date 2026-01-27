<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Format Email Salah',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            // [PENTING] Regenerate Session untuk mencegah Session Fixation
            $request->session()->regenerate();

            // Ambil data user
            $user = Auth::user(); // Gunakan Auth:: (kapital) agar konsisten

            // 3. Cek Role & Redirect
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'siswa':
                    return redirect()->route('siswa.dashboard'); // TYPO FIXED: 'dasshboard' -> 'dashboard'
                case 'mentor':
                    return redirect()->route('mentor.dashboard');
                case 'guru':
                    return redirect()->route('guru.dashboard');
                default:
                    // Jika role tidak dikenali, paksa logout
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/login')->withErrors('Role akun tidak valid, hubungi admin.');
            }
        } else {
            // 4. Jika Login Gagal
            return redirect()->back()
                // Gunakan key ['email' => ...] agar pesan error muncul tepat di bawah input email (jika pakai @error('email'))
                ->withErrors(['email' => 'Email atau password salah']) 
                ->withInput($request->except('password'));
        }
    }

    function logout(Request $request)
    {
        // [STANDAR KEAMANAN] Logout yang benar
        Auth::logout();
        
        // Menghapus sesi agar tidak bisa di-back
        $request->session()->invalidate();
        
        // Membuat ulang token CSRF
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Lebih baik redirect ke /login daripada '' (root)
    }
}