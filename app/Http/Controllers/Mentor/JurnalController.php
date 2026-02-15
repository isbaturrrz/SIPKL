<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $query = Jurnal::with(['siswa'])
            ->whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'pending')
            ->orderBy('tgl', 'desc')
            ->orderBy('created_at', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('tgl', $request->tanggal);
        }

        $jurnal = $query->get();

        $jumlahPending = Jurnal::whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'pending')
            ->count();

        return view('mentor.jurnal.index', compact('jurnal', 'jumlahPending'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $jurnal = Jurnal::with(['siswa', 'verifiedBy'])
            ->whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->findOrFail($id);

        return view('mentor.jurnal.show', compact('jurnal'));
    }

    public function verify(Request $request, $id)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $jurnal = Jurnal::whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->findOrFail($id);

        if ($jurnal->status_verifikasi !== 'pending') {
            return back()->with('error', 'Jurnal sudah diverifikasi sebelumnya!');
        }

        $jurnal->update([
            'status_verifikasi' => 'verified',
            'verified_by' => $user->id,
            'verified_at' => Carbon::now(),
            'keterangan_reject' => null
        ]);

        return redirect()->route('mentor.jurnal.index')
            ->with('success', 'Jurnal berhasil diverifikasi!');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan_reject' => 'required|string|max:500'
        ]);

        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $jurnal = Jurnal::whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->findOrFail($id);

        if ($jurnal->status_verifikasi !== 'pending') {
            return back()->with('error', 'Jurnal sudah diverifikasi sebelumnya!');
        }

        $jurnal->update([
            'status_verifikasi' => 'rejected',
            'verified_by' => $user->id,
            'verified_at' => Carbon::now(),
            'keterangan_reject' => $request->keterangan_reject
        ]);

        return redirect()->route('mentor.jurnal.index')
            ->with('success', 'Jurnal berhasil ditolak!');
    }
}