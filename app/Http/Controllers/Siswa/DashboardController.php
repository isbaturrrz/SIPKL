<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $siswa = Siswa::with(['instansi', 'guru'])
            ->where('id', $user->id)
            ->firstOrFail();
        
        $data = [
            'siswa' => $siswa,
            'nama' => $siswa->nama,
            'kelas_lengkap' => $siswa->kelas_lengkap,
            'jurusan_lengkap' => $siswa->jurusan_lengkap,
            'instansi_nama' => $siswa->instansi->nama_instansi ?? 'Belum ada instansi',
            'instansi_alamat' => $siswa->instansi->alamat ?? 'Alamat belum tersedia',
            'has_instansi' => $siswa->instansi !== null,
        ];
        
        return view('siswa.dashboard', $data);
    }
}