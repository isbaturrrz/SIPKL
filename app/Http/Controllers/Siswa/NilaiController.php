<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf;

class NilaiController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                Log::error('NilaiController: User not authenticated');
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
            }

            Log::info('NilaiController: User ID = ' . $user->id);

            // Cari siswa berdasarkan relasi atau field id
            $siswa = $user->siswa; // Menggunakan relasi
            
            // Jika relasi tidak ada, coba cari manual
            if (!$siswa) {
                $siswa = Siswa::where('id', $user->id)->first();
            }

            if (!$siswa) {
                Log::error('NilaiController: Siswa not found for user ID = ' . $user->id);
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Data siswa tidak ditemukan. Hubungi administrator.');
            }

            Log::info('NilaiController: Siswa found - ID: ' . $siswa->id_siswa . ', Nama: ' . $siswa->nama);

            // Ambil penilaian dengan eager loading
            $penilaian = Penilaian::with('instansi')
                ->where('id_siswa', $siswa->id_siswa)
                ->first();

            if ($penilaian) {
                Log::info('NilaiController: Penilaian found - ID: ' . $penilaian->id_nilai);
            } else {
                Log::info('NilaiController: No penilaian found for siswa ID: ' . $siswa->id_siswa);
            }

            return view('siswa.nilai.index', compact('siswa', 'penilaian'));
            
        } catch (\Exception $e) {
            Log::error('NilaiController Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Terjadi kesalahan sistem. Silakan hubungi administrator.');
        }
    }

    public function downloadPdf()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')
                    ->with('error', 'Silakan login terlebih dahulu');
            }

            // Cari siswa
            $siswa = $user->siswa ?? Siswa::where('id', $user->id)->first();

            if (!$siswa) {
                return redirect()->back()
                    ->with('error', 'Data siswa tidak ditemukan');
            }

            // Ambil penilaian
            $penilaian = Penilaian::with('instansi')
                ->where('id_siswa', $siswa->id_siswa)
                ->first();

            if (!$penilaian) {
                return redirect()->back()
                    ->with('error', 'Data penilaian belum tersedia. Hubungi pembimbing instansi.');
            }

            Log::info('Generating PDF for: ' . $siswa->nama);

            // Generate PDF
            $pdf = Pdf::loadView('siswa.nilai.pdf', compact('siswa', 'penilaian'))
                ->setPaper('a4', 'portrait');

            // Download dengan nama file yang clean
            $filename = 'Nilai_PKL_' . str_replace(' ', '_', $siswa->nama) . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            Log::error('PDF Generation Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Gagal mengunduh PDF. Silakan coba lagi.');
        }
    }
}