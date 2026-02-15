<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatJurnalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;

        $query = Jurnal::with(['siswa', 'verifiedBy'])
            ->whereHas('siswa', function($q) use ($instansiId) {
                $q->where('id_instansi', $instansiId);
            })
            ->where('status_verifikasi', 'verified')
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

        if ($request->has('kehadiran') && $request->kehadiran != '') {
            $query->where('status_kehadiran', $request->kehadiran);
        }

        $jurnal = $query->paginate(10);

        return view('mentor.riwayat.index', compact('jurnal'));
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

        return view('mentor.riwayat.show', compact('jurnal'));
    }
}