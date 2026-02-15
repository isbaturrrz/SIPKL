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

        $query = Siswa::where('id_instansi', $instansiId)
            ->orderBy('nama', 'asc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $siswa = $query->get();

        foreach ($siswa as $s) {
            $jurnalStats = DB::table('jurnal')
                ->where('id_siswa', $s->id_siswa)
                ->selectRaw('
                    COUNT(*) as total_jurnal,
                    SUM(CASE WHEN status_kehadiran = "hadir" THEN 1 ELSE 0 END) as total_hadir,
                    SUM(CASE WHEN status_verifikasi = "verified" THEN 1 ELSE 0 END) as total_verified
                ')
                ->first();

            $s->total_jurnal_all = $jurnalStats->total_jurnal ?? 0;
            $s->total_jurnal_hadir = $jurnalStats->total_hadir ?? 0;
            $s->total_jurnal_verified = $jurnalStats->total_verified ?? 0;

            $s->total_hari_kerja = $this->hitungHariKerja($s->tanggal_mulai, $s->tanggal_selesai);

            if ($s->total_hari_kerja > 0) {
                $s->persentase_kehadiran = round(($s->total_jurnal_hadir / $s->total_hari_kerja) * 100);
            } elseif ($s->total_jurnal_all > 0) {
                $s->persentase_kehadiran = round(($s->total_jurnal_hadir / $s->total_jurnal_all) * 100);
            } else {
                $s->persentase_kehadiran = 0;
            }

            if ($s->persentase_kehadiran > 100) {
                $s->persentase_kehadiran = 100;
            }

            $s->predikat = $this->getPredikat($s->persentase_kehadiran);
        }

        return view('mentor.siswa.index', compact('siswa'));
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
            ->selectRaw('
                COUNT(*) as total_jurnal,
                SUM(CASE WHEN status_kehadiran = "hadir" THEN 1 ELSE 0 END) as total_hadir,
                SUM(CASE WHEN status_kehadiran = "izin" THEN 1 ELSE 0 END) as total_izin,
                SUM(CASE WHEN status_kehadiran = "sakit" THEN 1 ELSE 0 END) as total_sakit,
                SUM(CASE WHEN status_kehadiran = "alfa" THEN 1 ELSE 0 END) as total_alfa,
                SUM(CASE WHEN status_kehadiran = "libur" THEN 1 ELSE 0 END) as total_libur,
                SUM(CASE WHEN status_verifikasi = "verified" THEN 1 ELSE 0 END) as total_verified,
                SUM(CASE WHEN status_verifikasi = "pending" THEN 1 ELSE 0 END) as total_pending,
                SUM(CASE WHEN status_verifikasi = "rejected" THEN 1 ELSE 0 END) as total_rejected
            ')
            ->first();

        $siswa->total_jurnal_all = $jurnalStats->total_jurnal ?? 0;
        $siswa->total_jurnal_hadir = $jurnalStats->total_hadir ?? 0;
        $siswa->total_jurnal_izin = $jurnalStats->total_izin ?? 0;
        $siswa->total_jurnal_sakit = $jurnalStats->total_sakit ?? 0;
        $siswa->total_jurnal_alfa = $jurnalStats->total_alfa ?? 0;
        $siswa->total_jurnal_libur = $jurnalStats->total_libur ?? 0;
        $siswa->total_jurnal_verified = $jurnalStats->total_verified ?? 0;
        $siswa->total_jurnal_pending = $jurnalStats->total_pending ?? 0;
        $siswa->total_jurnal_rejected = $jurnalStats->total_rejected ?? 0;

        $siswa->total_hari_kerja = $this->hitungHariKerja($siswa->tanggal_mulai, $siswa->tanggal_selesai);

        if ($siswa->total_hari_kerja > 0) {
            $siswa->persentase_kehadiran = round(($siswa->total_jurnal_hadir / $siswa->total_hari_kerja) * 100);
        } elseif ($siswa->total_jurnal_all > 0) {
            $siswa->persentase_kehadiran = round(($siswa->total_jurnal_hadir / $siswa->total_jurnal_all) * 100);
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

    private function hitungHariKerja($tglMulai, $tglSelesai)
    {
        if (!$tglMulai || !$tglSelesai) {
            return 0;
        }

        try {
            $start = Carbon::parse($tglMulai);
            $end = Carbon::parse($tglSelesai);
            
            if ($start->gt($end)) {
                return 0;
            }

            $hariKerja = 0;
            $current = $start->copy();

            while ($current->lte($end)) {
                if ($current->isWeekday()) {
                    $hariKerja++;
                }
                $current->addDay();
            }

            return $hariKerja;
        } catch (\Exception $e) {
            return 0;
        }
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