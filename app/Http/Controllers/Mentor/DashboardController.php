<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $totalSiswa = Siswa::where('id_instansi', $instansiId)->count();

        $jurnalHariIni = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            })
            ->whereDate('tgl', Carbon::today())
            ->count();

        $menungguVerifikasi = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'pending')
            ->count();

        $sudahVerifikasi = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'verified')
            ->count();

        $ditolak = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'rejected')
            ->count();

        $totalJurnal = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                $query->where('id_instansi', $instansiId);
            })
            ->count();

        $siswaList = Siswa::where('id_instansi', $instansiId)
                         ->orderBy('nama', 'asc')
                         ->limit(10)
                         ->get();

        foreach ($siswaList as $siswa) {
            $siswa->totalJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)->count();
            $siswa->jurnalVerified = Jurnal::where('id_siswa', $siswa->id_siswa)
                                          ->where('status_verifikasi', 'verified')
                                          ->count();
            $siswa->jurnalPending = Jurnal::where('id_siswa', $siswa->id_siswa)
                                         ->where('status_verifikasi', 'pending')
                                         ->count();
        }

        $jurnalPerBulan = [];
        $tahunSekarang = date('Y');
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jurnalPerBulan[$bulan] = Jurnal::whereHas('siswa', function($query) use ($instansiId) {
                                            $query->where('id_instansi', $instansiId);
                                        })
                                        ->whereYear('tgl', $tahunSekarang)
                                        ->whereMonth('tgl', $bulan)
                                        ->count();
        }

        $persentaseVerifikasi = $totalJurnal > 0 ? round(($sudahVerifikasi / $totalJurnal) * 100) : 0;
        $persentasePending = $totalJurnal > 0 ? round(($menungguVerifikasi / $totalJurnal) * 100) : 0;
        $persentaseDitolak = $totalJurnal > 0 ? round(($ditolak / $totalJurnal) * 100) : 0;

        return view('mentor.dashboard', compact(
            'totalSiswa',
            'jurnalHariIni',
            'menungguVerifikasi',
            'sudahVerifikasi',
            'ditolak',
            'totalJurnal',
            'siswaList',
            'jurnalPerBulan',
            'persentaseVerifikasi',
            'persentasePending',
            'persentaseDitolak'
        ));
    }
}