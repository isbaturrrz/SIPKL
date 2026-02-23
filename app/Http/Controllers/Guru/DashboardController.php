<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = Guru::where('id', $user->id)->first();

        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $guruId = $guru->id_guru;

        $totalSiswa = Siswa::where('id_guru', $guruId)->count();

        $siswaIds = Siswa::where('id_guru', $guruId)->pluck('id_siswa')->toArray();

        $kehadiranGlobal = [
            'hadir' => 0,
            'sakit' => 0,
            'izin' => 0,
            'libur' => 0,
            'alfa' => 0
        ];

        if (!empty($siswaIds)) {
            $kehadiranGlobal['hadir'] = Jurnal::whereIn('id_siswa', $siswaIds)
                                            ->whereIn('status_kehadiran', ['wfo', 'wfh'])
                                            ->where('status_verifikasi', 'verified')
                                            ->count();

            $kehadiranGlobal['sakit'] = Jurnal::whereIn('id_siswa', $siswaIds)
                                            ->where('status_kehadiran', 'sakit')
                                            ->where('status_verifikasi', 'verified')
                                            ->count();

            $kehadiranGlobal['izin'] = Jurnal::whereIn('id_siswa', $siswaIds)
                                            ->where('status_kehadiran', 'izin')
                                            ->where('status_verifikasi', 'verified')
                                            ->count();

            $kehadiranGlobal['libur'] = Jurnal::whereIn('id_siswa', $siswaIds)
                                            ->where('status_kehadiran', 'libur')
                                            ->where('status_verifikasi', 'verified')
                                            ->count();

            $kehadiranGlobal['alfa'] = Jurnal::whereIn('id_siswa', $siswaIds)
                                            ->where('status_kehadiran', 'alfa')
                                            ->where('status_verifikasi', 'verified')
                                            ->count();
        }

        $siswaList = Siswa::where('id_guru', $guruId)
                         ->orderBy('nama', 'asc')
                         ->limit(5)
                         ->get();

        foreach ($siswaList as $siswa) {
            $siswa->hadir = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->whereIn('status_kehadiran', ['wfo', 'wfh'])
                                  ->where('status_verifikasi', 'verified')
                                  ->count();
            
            $siswa->alfa = Jurnal::where('id_siswa', $siswa->id_siswa)
                                 ->where('status_kehadiran', 'alfa')
                                 ->where('status_verifikasi', 'verified')
                                 ->count();
        }

        $kehadiranPerBulan = [];
        $tahunSekarang = date('Y');
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $kehadiranPerBulan['hadir'][$bulan] = 0;
            $kehadiranPerBulan['tidakHadir'][$bulan] = 0;

            if (!empty($siswaIds)) {
                $kehadiranPerBulan['hadir'][$bulan] = Jurnal::whereIn('id_siswa', $siswaIds)
                                                           ->whereYear('tgl', $tahunSekarang)
                                                           ->whereMonth('tgl', $bulan)
                                                           ->whereIn('status_kehadiran', ['wfo', 'wfh'])
                                                           ->where('status_verifikasi', 'verified')
                                                           ->count();
                
                $kehadiranPerBulan['tidakHadir'][$bulan] = Jurnal::whereIn('id_siswa', $siswaIds)
                                                                ->whereYear('tgl', $tahunSekarang)
                                                                ->whereMonth('tgl', $bulan)
                                                                ->whereIn('status_kehadiran', ['sakit', 'alfa', 'izin'])
                                                                ->where('status_verifikasi', 'verified')
                                                                ->count();
            }
        }

        return view('guru.dashboard', compact(
            'totalSiswa',
            'kehadiranGlobal',
            'siswaList',
            'kehadiranPerBulan'
        ));
    }
}