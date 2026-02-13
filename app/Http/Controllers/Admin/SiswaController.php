<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $siswa = Siswa::with(['guru', 'instansi'])
        ->when($search, function ($query) use ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nipd', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);
        
        $totalSiswa = Siswa::count();
        $totalInstansi = Instansi::count();
        $totalGuru = Guru::count();

        $siswa->appends(['search' => $search]);

        return view('admin.siswa.index', compact('siswa', 'totalSiswa', 'totalInstansi', 'totalGuru'));
    }

    public function create()
    {
        $instansi = Instansi::with('guru')
            ->whereRaw('kuota_terpakai < kuota_siswa')
            ->get();
    
        return view('admin.siswa.create', compact('instansi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nipd' => 'required|unique:siswa,nipd|max:9',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|max:13',
            'alamat' => 'required|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'rombel' => 'nullable|numeric|min:1|max:99',
            'jurusan' => 'required|in:' . implode(',', array_keys(\App\Models\Siswa::JURUSAN_LIST)),
            'id_instansi' => 'nullable|exists:instansi,id_instansi',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        if ($request->id_instansi) {
            $instansi = Instansi::findOrFail($request->id_instansi);
            
            if ($instansi->kuota_terpakai >= $instansi->kuota_siswa) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Kuota instansi ' . $instansi->nama_instansi . ' sudah penuh!');
            }
        }

        DB::beginTransaction();
        
        try {
            $id_guru = null;
            if ($request->id_instansi) {
                $instansi = Instansi::findOrFail($request->id_instansi);
                $id_guru = $instansi->id_guru;
            }

            $user = User::create([
                'name' => $request->nama,
                'username' => $request->nipd,
                'password' => Hash::make($request->tgl_lahir),
                'role' => 'siswa'
            ]);

            Siswa::create([
                'id' => $user->id,
                'nipd' => $request->nipd,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'kelas' => $request->kelas,
                'rombel' => $request->rombel,
                'jurusan' => $request->jurusan,
                'id_guru' => $id_guru,
                'id_instansi' => $request->id_instansi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status_penempatan' => $request->id_instansi ? 'sudah' : 'belum'
            ]);

            if ($request->id_instansi) {
                Instansi::where('id_instansi', $request->id_instansi)
                    ->increment('kuota_terpakai');
            }

            DB::commit();

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
    
        $instansi = Instansi::with('guru')
            ->where(function($query) use ($siswa) {
                $query->whereRaw('kuota_terpakai < kuota_siswa')
                      ->orWhere('id_instansi', $siswa->id_instansi);
            })->get();

        return view('admin.siswa.edit', compact('siswa', 'instansi'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nipd' => 'required|max:9|unique:siswa,nipd,' . $id . ',id_siswa',
            'nama' => 'required|max:50',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|max:13',
            'alamat' => 'required|max:100',
            'kelas' => 'required|in:X,XI,XII',
            'rombel' => 'nullable|numeric|min:1|max:99',
            'jurusan' => 'required|in:' . implode(',', array_keys(\App\Models\Siswa::JURUSAN_LIST)),
            'id_instansi' => 'nullable|exists:instansi,id_instansi',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $instansiLama = $siswa->id_instansi;
        $instansiBaru = $request->id_instansi;

        if ($instansiBaru && $instansiBaru != $instansiLama) {
            $instansi = Instansi::findOrFail($instansiBaru);
            
            if ($instansi->kuota_terpakai >= $instansi->kuota_siswa) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Kuota instansi ' . $instansi->nama_instansi . ' sudah penuh!');
            }
        }

        DB::beginTransaction();
        
        try {
            $id_guru = null;
            if ($instansiBaru) {
                $instansi = Instansi::findOrFail($instansiBaru);
                $id_guru = $instansi->id_guru;
            }

            $siswa->update([
                'nipd' => $request->nipd,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'kelas' => $request->kelas,
                'rombel' => $request->rombel,
                'jurusan' => $request->jurusan,
                'id_guru' => $id_guru,
                'id_instansi' => $request->id_instansi,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status_penempatan' => $request->id_instansi ? 'sudah' : 'belum'
            ]);

            if ($instansiLama && $instansiBaru && $instansiLama != $instansiBaru) {
                Instansi::where('id_instansi', $instansiLama)->decrement('kuota_terpakai');
                Instansi::where('id_instansi', $instansiBaru)->increment('kuota_terpakai');
            }
            elseif (!$instansiLama && $instansiBaru) {
                Instansi::where('id_instansi', $instansiBaru)->increment('kuota_terpakai');
            }
            elseif ($instansiLama && !$instansiBaru) {
                Instansi::where('id_instansi', $instansiLama)->decrement('kuota_terpakai');
            }

            $user = User::find($siswa->id);
            if ($user) {
                $user->update([
                    'name' => $request->nama,
                    'username' => $request->nipd,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil diupdate!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            if ($siswa->id_instansi) {
                Instansi::where('id_instansi', $siswa->id_instansi)
                    ->decrement('kuota_terpakai');
            }

            User::where('id', $siswa->id)->delete();
            $siswa->delete();

            DB::commit();

            return redirect()->route('admin.siswa.index')
                ->with('success', 'Data siswa berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}