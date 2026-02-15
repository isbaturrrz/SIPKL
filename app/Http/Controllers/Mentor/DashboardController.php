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

        return view('mentor.dashboard', compact('totalSiswa', 'jurnalHariIni', 'menungguVerifikasi'));
    }
}