<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurnal;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = Guru::where('id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;
        
        $siswaList = Siswa::where('id_guru', $guruId)->get();
        
        foreach ($siswaList as $siswa) {
            $siswa->wfo = Jurnal::where('id_siswa', $siswa->id_siswa)
                                ->where('status_kehadiran', 'wfo')
                                ->where('status_verifikasi', 'verified')
                                ->count();

            $siswa->wfh = Jurnal::where('id_siswa', $siswa->id_siswa)
                                ->where('status_kehadiran', 'wfh')
                                ->where('status_verifikasi', 'verified')
                                ->count();
            
            $siswa->hadir = $siswa->wfo + $siswa->wfh;
            
            $siswa->izin = Jurnal::where('id_siswa', $siswa->id_siswa)
                                 ->where('status_kehadiran', 'izin')
                                 ->where('status_verifikasi', 'verified')
                                 ->count();
            
            $siswa->sakit = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->where('status_kehadiran', 'sakit')
                                  ->where('status_verifikasi', 'verified')
                                  ->count();
            
            $siswa->libur = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->where('status_kehadiran', 'libur')
                                  ->where('status_verifikasi', 'verified')
                                  ->count();
            
            $siswa->alfa = Jurnal::where('id_siswa', $siswa->id_siswa)
                                 ->where('status_kehadiran', 'alfa')
                                 ->where('status_verifikasi', 'verified')
                                 ->count();
        }
        
        return view('guru.siswa.index', compact('siswaList'));
    }
    
    public function updateStatus(Request $request, Siswa $siswa)
    {
        $user = Auth::user();
        $guru = Guru::where('id', $user->id)->first();
        
        if (!$guru || $siswa->id_guru != $guru->id_guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk siswa ini');
        }
        
        $request->validate([
            'status' => 'required|in:alfa',
            'tanggal' => 'required|date|before_or_equal:today'
        ], [
            'tanggal.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini'
        ]);
        
        $existingJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
                                ->whereDate('tgl', $request->tanggal)
                                ->first();
        
        if ($existingJurnal) {
            return redirect()->back()->with('error', 
                'Sudah ada catatan jurnal untuk siswa <strong>' . $siswa->nama . '</strong> pada tanggal ' . 
                date('d-m-Y', strtotime($request->tanggal)) . 
                ' dengan status <strong>' . strtoupper($existingJurnal->status_kehadiran) . '</strong>. ' .
                'Silakan ubah status di menu <strong>Jurnal Siswa</strong> jika ingin mengubah status kehadiran.'
            );
        }
        
        Jurnal::create([
            'id_siswa' => $siswa->id_siswa,
            'tgl' => $request->tanggal,
            'jam_mulai' => '00:00',
            'jam_selesai' => '00:00',
            'status_kehadiran' => 'alfa',
            'status_verifikasi' => 'verified',
            'verified_by' => 'guru',
            'input_by' => 'guru',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->back()->with('success', 
            'Siswa <strong>' . $siswa->nama . '</strong> berhasil ditandai <strong>ALFA</strong> pada tanggal ' . 
            date('d-m-Y', strtotime($request->tanggal))
        );
    }

    public function downloadPdf(Request $request)
    {
        $user = Auth::user();
        $guru = Guru::where('id', $user->id)->first();
        
        if (!$guru) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan');
        }

        $request->validate([
            'siswa' => 'required|exists:siswa,id_siswa',
            'rentang_waktu' => 'required'
        ], [
            'siswa.required' => 'Pilih siswa terlebih dahulu',
            'rentang_waktu.required' => 'Pilih rentang waktu terlebih dahulu'
        ]);

        $siswa = Siswa::findOrFail($request->siswa);
        
        if ($siswa->id_guru != $guru->id_guru) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk siswa ini');
        }

        // Ambil data instansi dari relasi siswa
        // Asumsikan siswa memiliki relasi ke instansi (id_instansi)
        $instansi = null;
        if ($siswa->id_instansi) {
            $instansi = \App\Models\Instansi::find($siswa->id_instansi);
        }

        $bulanList = [
            'januari' => ['bulan' => 1, 'nama' => 'Januari'],
            'februari' => ['bulan' => 2, 'nama' => 'Februari'],
            'maret' => ['bulan' => 3, 'nama' => 'Maret'],
            'april' => ['bulan' => 4, 'nama' => 'April'],
            'mei' => ['bulan' => 5, 'nama' => 'Mei'],
            'juni' => ['bulan' => 6, 'nama' => 'Juni'],
            'juli' => ['bulan' => 7, 'nama' => 'Juli'],
            'agustus' => ['bulan' => 8, 'nama' => 'Agustus'],
            'september' => ['bulan' => 9, 'nama' => 'September'],
            'oktober' => ['bulan' => 10, 'nama' => 'Oktober'],
            'november' => ['bulan' => 11, 'nama' => 'November'],
            'desember' => ['bulan' => 12, 'nama' => 'Desember'],
        ];

        $tahunSekarang = date('Y');

        if ($request->rentang_waktu === 'semua') {
            $data = [];
            
            foreach ($bulanList as $kode => $infobulan) {
                $bulan = $infobulan['bulan'];
                $namaBulan = $infobulan['nama'];

                $jurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
                            ->where('status_verifikasi', 'verified')
                            ->whereYear('tgl', $tahunSekarang)
                            ->whereMonth('tgl', $bulan)
                            ->get();

                $data[] = [
                    'bulan' => $namaBulan,
                    'tahun' => $tahunSekarang,
                    'jurnal' => $jurnal,
                    'performa' => $this->hitungPerforma($jurnal)
                ];
            }

            $pdf = Pdf::loadView('guru.siswa.pdf-semua-bulan', [
                'siswa' => $siswa,
                'guru' => $guru,
                'instansi' => $instansi, // Tambahkan instansi
                'data' => $data,
                'bulanList' => $bulanList
            ]);

            $filename = 'Performa_' . str_replace(' ', '_', $siswa->nama) . '_Semua_Bulan_' . $tahunSekarang . '.pdf';
            
        } else {
            if (!isset($bulanList[$request->rentang_waktu])) {
                return redirect()->back()->with('error', 'Rentang waktu tidak valid');
            }

            $infobulan = $bulanList[$request->rentang_waktu];
            $bulan = $infobulan['bulan'];
            $namaBulan = $infobulan['nama'];

            $jurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
                        ->where('status_verifikasi', 'verified')
                        ->whereYear('tgl', $tahunSekarang)
                        ->whereMonth('tgl', $bulan)
                        ->orderBy('tgl', 'asc')
                        ->get();

            $performa = $this->hitungPerforma($jurnal);

            $pdf = Pdf::loadView('guru.siswa.pdf-single-bulan', [
                'siswa' => $siswa,
                'guru' => $guru,
                'instansi' => $instansi, // Tambahkan instansi
                'bulan' => $namaBulan,
                'tahun' => $tahunSekarang,
                'jurnal' => $jurnal,
                'performa' => $performa
            ]);

            $filename = 'Performa_' . str_replace(' ', '_', $siswa->nama) . '_' . $namaBulan . '_' . $tahunSekarang . '.pdf';
        }

        return $pdf->download($filename);
    }

    private function hitungPerforma($jurnal)
    {
        $performa = [
            'wfo' => 0,
            'wfh' => 0,
            'izin' => 0,
            'sakit' => 0,
            'libur' => 0,
            'alfa' => 0,
            'total' => 0
        ];

        foreach ($jurnal as $item) {
            $status = $item->status_kehadiran;
            if (isset($performa[$status])) {
                $performa[$status]++;
            }
            $performa['total']++;
        }

        return $performa;
    }
}