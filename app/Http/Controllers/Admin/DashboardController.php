<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalInstansi = Instansi::count();
        $totalUser = User::count();

        $siswaAktif = Siswa::where('status_penempatan', 'sudah')->count();
        $siswaBeluDitempatkan = Siswa::where('status_penempatan', 'belum')->count();
        
        $totalJurnal = Jurnal::where('status_verifikasi', 'verified')->count();
        $jurnalHariIni = Jurnal::whereDate('tgl', Carbon::today())
                              ->where('status_verifikasi', 'verified')
                              ->count();

        $siswaPerJurusan = Siswa::select('jurusan')
                                ->selectRaw('COUNT(*) as belum_ditempatkan, 0 as sudah_ditempatkan')
                                ->where('status_penempatan', 'belum')
                                ->groupBy('jurusan')
                                ->get()
                                ->keyBy('jurusan');

        $siswaPerJurusanSudah = Siswa::select('jurusan')
                                    ->selectRaw('COUNT(*) as count')
                                    ->where('status_penempatan', 'sudah')
                                    ->groupBy('jurusan')
                                    ->get()
                                    ->keyBy('jurusan');

        $jurusanList = ['PPLG', 'DKV', 'BRP'];
        
        $chartData = [];
        foreach ($jurusanList as $jurusan) {
            $chartData[$jurusan] = [
                'belum_ditempatkan' => $siswaPerJurusan[$jurusan]['belum_ditempatkan'] ?? 0,
                'sudah_ditempatkan' => $siswaPerJurusanSudah[$jurusan]['count'] ?? 0
            ];
        }

        $siswaPerJurusanTotal = [];
        foreach ($jurusanList as $jurusan) {
            $siswaPerJurusanTotal[$jurusan] = Siswa::where('jurusan', $jurusan)->count();
        }

        $siswaJurusanData = [];
        foreach ($jurusanList as $jurusan) {
            $siswaJurusanData[$jurusan] = Siswa::where('jurusan', $jurusan)->count();
        }

        $instansiData = Instansi::select('nama_instansi')
                               ->selectRaw('COUNT(siswa.id_siswa) as jumlah_siswa')
                               ->leftJoin('siswa', 'instansi.id_instansi', '=', 'siswa.id_instansi')
                               ->groupBy('instansi.id_instansi', 'nama_instansi')
                               ->orderBy('jumlah_siswa', 'desc')
                               ->limit(5)
                               ->get();

        $jurnalPerBulan = [];
        $tahunSekarang = date('Y');
        
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $jurnalPerBulan[$bulan] = Jurnal::whereYear('tgl', $tahunSekarang)
                                           ->whereMonth('tgl', $bulan)
                                           ->where('status_verifikasi', 'verified')
                                           ->count();
        }

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalInstansi',
            'totalUser',
            'siswaAktif',
            'siswaBeluDitempatkan',
            'totalJurnal',
            'jurnalHariIni',
            'chartData',
            'siswaPerJurusanTotal',
            'jurusanList',
            'siswaJurusanData',
            'instansiData',
            'jurnalPerBulan'
        ));
    }
}