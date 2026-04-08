<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $siswaList = Siswa::with('guru')
            ->where('id_instansi', $instansiId)
            ->orderBy('nama', 'asc')
            ->get();

        foreach ($siswaList as $s) {
            $jurnalStats = DB::table('jurnal')
                ->where('id_siswa', $s->id_siswa)
                ->where('status_verifikasi', 'verified')
                ->selectRaw('
                    COUNT(*) as total_jurnal,
                    SUM(CASE WHEN status_kehadiran = "wfo" THEN 1 ELSE 0 END) as total_wfo,
                    SUM(CASE WHEN status_kehadiran = "wfh" THEN 1 ELSE 0 END) as total_wfh,
                    SUM(CASE WHEN status_kehadiran = "izin" THEN 1 ELSE 0 END) as total_izin,
                    SUM(CASE WHEN status_kehadiran = "sakit" THEN 1 ELSE 0 END) as total_sakit,
                    SUM(CASE WHEN status_kehadiran = "alfa" THEN 1 ELSE 0 END) as total_alfa,
                    SUM(CASE WHEN status_kehadiran = "libur" THEN 1 ELSE 0 END) as total_libur
                ')
                ->first();

            $s->total_jurnal_all = $jurnalStats->total_jurnal ?? 0;
            $s->total_jurnal_wfo = $jurnalStats->total_wfo ?? 0;
            $s->total_jurnal_wfh = $jurnalStats->total_wfh ?? 0;
            $s->total_jurnal_izin = $jurnalStats->total_izin ?? 0;
            $s->total_jurnal_sakit = $jurnalStats->total_sakit ?? 0;
            $s->total_jurnal_alfa = $jurnalStats->total_alfa ?? 0;
            $s->total_jurnal_libur = $jurnalStats->total_libur ?? 0;

            $s->total_jurnal_hadir = $s->total_jurnal_wfo + $s->total_jurnal_wfh;
            $s->total_jurnal_tidak_hadir = $s->total_jurnal_izin + $s->total_jurnal_sakit + $s->total_jurnal_alfa;
            
            $totalUntukPersentase = $s->total_jurnal_hadir + $s->total_jurnal_tidak_hadir;

            if ($totalUntukPersentase > 0) {
                $s->persentase_kehadiran = round(($s->total_jurnal_hadir / $totalUntukPersentase) * 100);
            } else {
                $s->persentase_kehadiran = 0;
            }

            if ($s->persentase_kehadiran > 100) {
                $s->persentase_kehadiran = 100;
            }

            $s->predikat = $this->getPredikat($s->persentase_kehadiran);
        }

        return view('mentor.siswa.index', compact('siswaList'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $siswa = Siswa::with(['instansi', 'guru'])
            ->where('id_instansi', $instansiId)
            ->findOrFail($id);

        $jurnalStats = DB::table('jurnal')
            ->where('id_siswa', $siswa->id_siswa)
            ->where('status_verifikasi', 'verified')
            ->selectRaw('
                COUNT(*) as total_jurnal,
                SUM(CASE WHEN status_kehadiran = "wfo" THEN 1 ELSE 0 END) as total_wfo,
                SUM(CASE WHEN status_kehadiran = "wfh" THEN 1 ELSE 0 END) as total_wfh,
                SUM(CASE WHEN status_kehadiran = "izin" THEN 1 ELSE 0 END) as total_izin,
                SUM(CASE WHEN status_kehadiran = "sakit" THEN 1 ELSE 0 END) as total_sakit,
                SUM(CASE WHEN status_kehadiran = "alfa" THEN 1 ELSE 0 END) as total_alfa,
                SUM(CASE WHEN status_kehadiran = "libur" THEN 1 ELSE 0 END) as total_libur
            ')
            ->first();

        $jurnalVerifikasiStats = DB::table('jurnal')
            ->where('id_siswa', $siswa->id_siswa)
            ->selectRaw('
                SUM(CASE WHEN status_verifikasi = "verified" THEN 1 ELSE 0 END) as total_verified,
                SUM(CASE WHEN status_verifikasi = "pending" THEN 1 ELSE 0 END) as total_pending,
                SUM(CASE WHEN status_verifikasi = "rejected" THEN 1 ELSE 0 END) as total_rejected
            ')
            ->first();

        $siswa->total_jurnal_all = $jurnalStats->total_jurnal ?? 0;
        $siswa->total_jurnal_wfo = $jurnalStats->total_wfo ?? 0;
        $siswa->total_jurnal_wfh = $jurnalStats->total_wfh ?? 0;
        $siswa->total_jurnal_izin = $jurnalStats->total_izin ?? 0;
        $siswa->total_jurnal_sakit = $jurnalStats->total_sakit ?? 0;
        $siswa->total_jurnal_alfa = $jurnalStats->total_alfa ?? 0;
        $siswa->total_jurnal_libur = $jurnalStats->total_libur ?? 0;
        $siswa->total_jurnal_verified = $jurnalVerifikasiStats->total_verified ?? 0;
        $siswa->total_jurnal_pending = $jurnalVerifikasiStats->total_pending ?? 0;
        $siswa->total_jurnal_rejected = $jurnalVerifikasiStats->total_rejected ?? 0;

        $siswa->total_jurnal_hadir = $siswa->total_jurnal_wfo + $siswa->total_jurnal_wfh;
        $siswa->total_jurnal_tidak_hadir = $siswa->total_jurnal_izin + $siswa->total_jurnal_sakit + $siswa->total_jurnal_alfa;

        $totalUntukPersentase = $siswa->total_jurnal_hadir + $siswa->total_jurnal_tidak_hadir;

        if ($totalUntukPersentase > 0) {
            $siswa->persentase_kehadiran = round(($siswa->total_jurnal_hadir / $totalUntukPersentase) * 100);
        } else {
            $siswa->persentase_kehadiran = 0;
        }

        if ($siswa->persentase_kehadiran > 100) {
            $siswa->persentase_kehadiran = 100;
        }

        $siswa->predikat = $this->getPredikat($siswa->persentase_kehadiran);

        $recentJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->orderBy('tgl', 'desc')
            ->limit(10)
            ->get();

        return view('mentor.siswa.show', compact('siswa', 'recentJurnal'));
    }

    private function getPredikat($persentase)
    {
        if ($persentase >= 90) {
            return 'A';
        } elseif ($persentase >= 80) {
            return 'B';
        } elseif ($persentase >= 70) {
            return 'C';
        } elseif ($persentase >= 60) {
            return 'D';
        } else {
            return 'E';
        }
    }
}