<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurnal;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $siswa->hadir = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->where('status_kehadiran', 'hadir')
                                  ->count();
            
            $siswa->izin = Jurnal::where('id_siswa', $siswa->id_siswa)
                                 ->where('status_kehadiran', 'izin')
                                 ->count();
            
            $siswa->sakit = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->where('status_kehadiran', 'sakit')
                                  ->count();
            
            $siswa->libur = Jurnal::where('id_siswa', $siswa->id_siswa)
                                  ->where('status_kehadiran', 'libur')
                                  ->count();
            
            $siswa->alfa = Jurnal::where('id_siswa', $siswa->id_siswa)
                                 ->where('status_kehadiran', 'alfa')
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
            'jam_mulai' => '00:00:00',
            'jam_selesai' => '00:00:00',
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
}