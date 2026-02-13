<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;


Route::middleware(['guest'])->group(function () {
    
    Route::get('/', function () {
        return redirect()->route('login');
    });
 
    Route::get('/login', [AuthController::class, 'index'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('siswa', App\Http\Controllers\Admin\SiswaController::class);

        Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);

        Route::resource('instansi', App\Http\Controllers\Admin\InstansiController::class);

        Route::resource('user',  App\Http\Controllers\Admin\UserController::class);
    
        Route::resource('sistem',  App\Http\Controllers\Admin\SistemController::class);
    });



Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {       
        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');
    });



Route::middleware(['auth', 'role:mentor'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {      
        Route::get('/dashboard', function () {
            return view('mentor.dashboard');
        })->name('dashboard');
    });


Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {      
        Route::get('/dashboard', function () {return view('guru.dashboard');
        })->name('dashboard');

        Route::get('/siswa', [App\Http\Controllers\Guru\SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/siswa/{siswa}/update-status', [App\Http\Controllers\Guru\SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');

        Route::get('/jurnal', [App\Http\Controllers\Guru\JurnalController::class, 'index'])->name('jurnal.index');
        Route::get('/jurnal/create', [App\Http\Controllers\Guru\JurnalController::class, 'create'])->name('jurnal.create');
        Route::post('/jurnal', [App\Http\Controllers\Guru\JurnalController::class, 'store'])->name('jurnal.store');
        Route::get('/jurnal/{id}', [App\Http\Controllers\Guru\JurnalController::class, 'show'])->name('jurnal.show');
    });