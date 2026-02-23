<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $guru = Guru::where('id', $userId)->first();

        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $siswaList = Siswa::where('id_guru', $guruId)->get();
        
        $siswaBimbingan = $siswaList->pluck('id_siswa')->toArray();
        
        $queryVerified = Jurnal::with(['siswa.user', 'siswa.instansi'])
                    ->whereIn('id_siswa', $siswaBimbingan)
                    ->where('status_verifikasi', 'verified');
        
        $queryUnverified = Jurnal::with(['siswa.user', 'siswa.instansi'])
                    ->whereIn('id_siswa', $siswaBimbingan)
                    ->where('status_verifikasi', 'pending');
        
        if ($request->filled('siswa_id')) {
            $queryVerified->where('id_siswa', $request->siswa_id);
            $queryUnverified->where('id_siswa', $request->siswa_id);
        }
        
        if ($request->filled('tanggal')) {
            $queryVerified->whereDate('tgl', $request->tanggal);
            $queryUnverified->whereDate('tgl', $request->tanggal);
        }
        
        if ($request->filled('bulan')) {
            $bulan = date('m', strtotime($request->bulan));
            $tahun = date('Y', strtotime($request->bulan));
            $queryVerified->whereMonth('tgl', $bulan)->whereYear('tgl', $tahun);
            $queryUnverified->whereMonth('tgl', $bulan)->whereYear('tgl', $tahun);
        }
        
        $jurnalsVerified = $queryVerified->orderBy('tgl', 'desc')
                        ->orderBy('jam_mulai', 'desc')
                        ->paginate(10, ['*'], 'verified_page');
        
        $jurnalsUnverified = $queryUnverified->orderBy('tgl', 'desc')
                        ->orderBy('jam_mulai', 'desc')
                        ->paginate(10, ['*'], 'unverified_page');
        
        return view('guru.jurnal.index', compact('jurnalsVerified', 'jurnalsUnverified', 'siswaList'));
    }

    public function create()
    {
        $userId = Auth::id();

        $guru = Guru::where('id', $userId)->first();
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $siswaList = Siswa::with(['user', 'instansi'])
                        ->where('id_guru', $guruId)
                        ->get();
        
        return view('guru.jurnal.create', compact('siswaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'tgl' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_kehadiran' => 'required|in:wfo,wfh,izin,sakit,izin,libur,alfa',
            'kegiatan' => 'required|string',
            'manfaat' => 'required|string',
            'wfh' => 'nullable|boolean'
        ], [
            'id_siswa.required' => 'Pilih siswa terlebih dahulu',
            'tgl.required' => 'Tanggal harus diisi',
            'jam_mulai.required' => 'Jam mulai harus diisi',
            'jam_selesai.required' => 'Jam selesai harus diisi',
            'status_kehadiran.required' => 'Status kehadiran harus dipilih',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'manfaat.required' => 'Manfaat harus diisi'
        ]);

        $userId = Auth::id();
        
        $guru = Guru::where('id', $userId)->first();

        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $siswa = Siswa::where('id_siswa', $request->id_siswa)
                    ->where('id_guru', $guruId)
                    ->first();
        
        if (!$siswa) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Anda tidak memiliki akses untuk siswa ini');
        }

        $existingJurnal = Jurnal::where('id_siswa', $request->id_siswa)
                                ->whereDate('tgl', $request->tgl)
                                ->first();
        
        if ($existingJurnal) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Jurnal untuk siswa ini pada tanggal tersebut sudah ada');
        }

        Jurnal::create([    
            'id_siswa' => $request->id_siswa,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_kehadiran' => $request->status_kehadiran,
            'kegiatan' => $request->kegiatan,
            'manfaat' => $request->manfaat,
            'status_verifikasi' => 'pending',
            'input_by' => 'guru',
        ]);
        
        return redirect()->route('guru.jurnal.index')
                        ->with('success', 'Jurnal berhasil ditambahkan. Menunggu verifikasi dari pembimbing instansi.');
    }

    public function show(string $id)
    {
        $userId = Auth::id();

        $guru = Guru::where('id', $userId)->first();
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;
        
        $jurnal = Jurnal::with(['siswa.user', 'siswa.instansi', 'verifiedBy'])
                    ->whereHas('siswa', function($query) use ($guruId) {
                        $query->where('id_guru', $guruId);
                    })
                    ->findOrFail($id);
        
        return view('guru.jurnal.show', compact('jurnal'));
    }

    public function edit(string $id)
    {
        $userId = Auth::id();

        $guru = Guru::where('id', $userId)->first();
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $jurnal = Jurnal::with(['siswa'])
                    ->whereHas('siswa', function($query) use ($guruId) {
                        $query->where('id_guru', $guruId);
                    })
                    ->where('status_verifikasi', 'pending')
                    ->findOrFail($id);

        $siswaList = Siswa::with(['user', 'instansi'])
                        ->where('id_guru', $guruId)
                        ->get();
        
        return view('guru.jurnal.edit', compact('jurnal', 'siswaList'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'tgl' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_kehadiran' => 'required|in:wfo,wfh,izin,sakit,libur,alfa',
            'kegiatan' => 'required|string',
            'manfaat' => 'required|string',
        ], [
            'id_siswa.required' => 'Pilih siswa terlebih dahulu',
            'tgl.required' => 'Tanggal harus diisi',
            'jam_mulai.required' => 'Jam mulai harus diisi',
            'jam_selesai.required' => 'Jam selesai harus diisi',
            'status_kehadiran.required' => 'Status kehadiran harus dipilih',
            'kegiatan.required' => 'Kegiatan harus diisi',
            'manfaat.required' => 'Manfaat harus diisi'
        ]);

        $userId = Auth::id();
        
        $guru = Guru::where('id', $userId)->first();

        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $jurnal = Jurnal::whereHas('siswa', function($query) use ($guruId) {
                        $query->where('id_guru', $guruId);
                    })
                    ->where('status_verifikasi', 'pending')
                    ->findOrFail($id);

        $siswa = Siswa::where('id_siswa', $request->id_siswa)
                    ->where('id_guru', $guruId)
                    ->first();
        
        if (!$siswa) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Anda tidak memiliki akses untuk siswa ini');
        }

        $existingJurnal = Jurnal::where('id_siswa', $request->id_siswa)
                                ->whereDate('tgl', $request->tgl)
                                ->where('id_jurnal', '!=', $id)
                                ->first();
        
        if ($existingJurnal) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Jurnal untuk siswa ini pada tanggal tersebut sudah ada');
        }

        $jurnal->update([
            'id_siswa' => $request->id_siswa,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_kehadiran' => $request->status_kehadiran,
            'kegiatan' => $request->kegiatan,
            'manfaat' => $request->manfaat,
        ]);
        
        return redirect()->route('guru.jurnal.index')
                        ->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $userId = Auth::id();

        $guru = Guru::where('id', $userId)->first();
        
        if (!$guru) {
            return redirect()->route('guru.dashboard')->with('error', 'Data guru tidak ditemukan');
        }
        
        $guruId = $guru->id_guru;

        $jurnal = Jurnal::whereHas('siswa', function($query) use ($guruId) {
                        $query->where('id_guru', $guruId);
                    })
                    ->findOrFail($id);

        $jurnal->delete();
        
        return redirect()->route('guru.jurnal.index')
                        ->with('success', 'Jurnal berhasil dihapus.');
    }
}