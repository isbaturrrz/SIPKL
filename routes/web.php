<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    
    // 1. Jika user buka website utama (root), lempar ke /login
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // 2. Tampilkan Halaman Login (Ini solusi error GET not supported)
    // URL: http://127.0.0.1:8000/login
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    // 3. Proses Submit Login
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// --- ROUTE LOGOUT ---
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// --- 1. GROUP ADMIN ---
// URL: /admin/dashboard
// Route Name: admin.dashboard
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');       
        // Contoh jika nanti nambah halaman profil admin
        // Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        // Hasil URL: /admin/profile
    });


// --- 2. GROUP SISWA ---
// URL: /siswa/dashboard
// Route Name: siswa.dashboard
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {       
        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');
    });


// --- 3. GROUP MENTOR ---
// URL: /mentor/dashboard
// Route Name: mentor.dashboard
Route::middleware(['auth', 'role:mentor'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {      
        Route::get('/dashboard', function () {
            return view('mentor.dashboard');
        })->name('dashboard');
    });

// --- 4. GROUP GURU ---
// URL: /guru/dashboard
// Route Name: guru.dashboard
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {      
        Route::get('/dashboard', function () {
            return view('guru.dashboard');
        })->name('dashboard');
    });