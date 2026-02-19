<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $instansiId = $user->id_instansi;
        $search = $request->search;

        $siswa = Siswa::where('id_instansi', $instansiId) 
            ->when($search, function($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            })
            ->with('penilaian')
            ->orderBy('nama', 'asc')
            ->paginate(10);

        return view('mentor.nilai.index', compact('siswa'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        
        $siswa = Siswa::where('id_instansi', $user->id_instansi)
            ->findOrFail($request->id_siswa);

        return view('mentor.nilai.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'nilai_kreatifitas' => 'required|numeric|between:0,100',
            'nilai_kedisiplinan' => 'required|numeric|between:0,100',
            'nilai_keaktifan' => 'required|numeric|between:0,100',
            'nilai_kerjasama' => 'required|numeric|between:0,100',
        ]);

        $user = Auth::user();

        $nilai_akhir = ($request->nilai_kreatifitas + $request->nilai_kedisiplinan + $request->nilai_keaktifan + $request->nilai_kerjasama) / 4;

        \App\Models\Penilaian::updateOrCreate(
            ['id_siswa' => $request->id_siswa],
            [
                'id_instansi' => $user->id_instansi, 
                'nilai_kreatifitas' => $request->nilai_kreatifitas,
                'nilai_kedisiplinan' => $request->nilai_kedisiplinan,
                'nilai_keaktifan' => $request->nilai_keaktifan,
                'nilai_kerjasama' => $request->nilai_kerjasama,
                'nilai_akhir' => $nilai_akhir,
                'keterangan' => $request->keterangan
            ]
        );

        return redirect()->route('mentor.nilai.index')->with('success', 'Nilai berhasil disimpan');
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = Siswa::where('id_instansi', $user->id_instansi)
                    ->with('penilaian')
                    ->findOrFail($id);

        return view('mentor.nilai.show', compact('siswa'));
    }
    
    public function edit($id)
    {
        $user = Auth::user();
        $siswa = Siswa::where('id_instansi', $user->id_instansi)
                    ->with('penilaian')
                    ->findOrFail($id);

        return view('mentor.nilai.edit', compact('siswa'));
    }
}