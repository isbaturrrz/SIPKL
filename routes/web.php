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

        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    
        Route::get('/sistem', [App\Http\Controllers\Admin\SistemController::class, 'index'])->name('sistem.index');
        Route::post('/sistem/update', [App\Http\Controllers\Admin\SistemController::class, 'update'])->name('sistem.update');

        Route::get('/import', [App\Http\Controllers\Admin\ImportController::class, 'index'])->name('import.index');
        Route::post('/import/siswa', [App\Http\Controllers\Admin\ImportController::class, 'importSiswa'])->name('import.siswa');
        Route::post('/import/instansi', [App\Http\Controllers\Admin\ImportController::class, 'importInstansi'])->name('import.instansi');
        Route::post('/import/guru', [App\Http\Controllers\Admin\ImportController::class, 'importGuru'])->name('import.guru');
        Route::get('/import/template/siswa', [App\Http\Controllers\Admin\ImportController::class, 'downloadTemplateSiswa'])->name('import.template.siswa');
        Route::get('/import/template/instansi', [App\Http\Controllers\Admin\ImportController::class, 'downloadTemplateInstansi'])->name('import.template.instansi');
        Route::get('/import/template/guru', [App\Http\Controllers\Admin\ImportController::class, 'downloadTemplateGuru'])->name('import.template.guru');

        Route::get('/pengajuan-instansi', [App\Http\Controllers\Admin\PengajuanInstansiController::class, 'index'])->name('pengajuan-instansi.index');
        Route::get('/pengajuan-instansi/{id}', [App\Http\Controllers\Admin\PengajuanInstansiController::class, 'show'])->name('pengajuan-instansi.show');
        Route::post('/pengajuan-instansi/{id}/approve', [App\Http\Controllers\Admin\PengajuanInstansiController::class, 'approve'])->name('pengajuan-instansi.approve');
        Route::post('/pengajuan-instansi/{id}/reject', [App\Http\Controllers\Admin\PengajuanInstansiController::class, 'reject'])->name('pengajuan-instansi.reject');
    });


Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {       
        Route::get('/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('jurnal', App\Http\Controllers\Siswa\JurnalController::class);

        Route::get('/nilai', [App\Http\Controllers\Siswa\NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai/download-pdf', [App\Http\Controllers\Siswa\NilaiController::class, 'downloadPdf'])->name('nilai.download');

        Route::get('/instansi', [App\Http\Controllers\Siswa\InstansiController::class, 'index'])->name('instansi.index');
        Route::get('/instansi/create', [App\Http\Controllers\Siswa\InstansiController::class, 'create'])->name('instansi.create');
        Route::post('/instansi/store', [App\Http\Controllers\Siswa\InstansiController::class, 'store'])->name('instansi.store');
        Route::post('/instansi/pilih/{id}', [App\Http\Controllers\Siswa\InstansiController::class, 'pilih'])->name('instansi.pilih');

        Route::get('/leaderboard', [App\Http\Controllers\Siswa\LeaderboardController::class, 'index'])->name('leaderboard.index');
    });



Route::middleware(['auth', 'role:mentor'])
    ->prefix('mentor')
    ->name('mentor.')
    ->group(function () {      
        Route::get('/dashboard', [App\Http\Controllers\Mentor\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('siswa', App\Http\Controllers\Mentor\SiswaController::class)
            ->only(['index', 'show']);

        Route::resource('jurnal', App\Http\Controllers\Mentor\JurnalController::class)
            ->only(['index', 'show']);
        
        Route::post('jurnal/{jurnal}/verify', [App\Http\Controllers\Mentor\JurnalController::class, 'verify'])
            ->name('jurnal.verify');
        
        Route::post('jurnal/{jurnal}/reject', [App\Http\Controllers\Mentor\JurnalController::class, 'reject'])
            ->name('jurnal.reject');

        Route::get('/riwayat-jurnal', [App\Http\Controllers\Mentor\RiwayatJurnalController::class, 'index'])
            ->name('riwayat.index');
        
        Route::get('/riwayat-jurnal/{id}', [App\Http\Controllers\Mentor\RiwayatJurnalController::class, 'show'])
            ->name('riwayat.show');

        Route::resource('nilai', App\Http\Controllers\Mentor\NilaiController::class);
    });


Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {      
         Route::get('/dashboard', [ App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('siswa', App\Http\Controllers\Guru\SiswaController::class)
            ->only(['index', 'show']);

        Route::post('siswa/{siswa}/update-status', [App\Http\Controllers\Guru\SiswaController::class, 'updateStatus'])
            ->name('siswa.updateStatus');

        Route::resource('jurnal', App\Http\Controllers\Guru\JurnalController::class);

        Route::post('/siswa/download-pdf', [App\Http\Controllers\Guru\SiswaController::class, 'downloadPdf'])->name('siswa.download-pdf');
    });