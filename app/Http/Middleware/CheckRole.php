<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     * $role adalah parameter tambahan yang kita kirim dari route
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah role user SAMA dengan role yang diizinkan
        if (Auth::user()->role == $role) {
            return $next($request); // Silakan masuk
        }

        // 3. Jika role tidak cocok, tendang keluar atau tampilkan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}