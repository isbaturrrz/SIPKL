<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Instansi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalInstansi = Instansi::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalInstansi'));
    }
}