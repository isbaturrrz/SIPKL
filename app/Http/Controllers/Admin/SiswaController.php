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
    public function index()
    {
        $siswa = Siswa::with(['guru', 'instansi'])->get();
        $totalSiswa = Siswa::count();
        $totalInstansi = Instansi::count();
        $totalGuru = Guru::count();

        return view('admin.siswa.index', compact('siswa', 'totalSiswa', 'totalInstansi', 'totalGuru'));
    }

    public function create()
    {
        $guru = Guru::all();
        $instansi = Instansi::all();
        
        return view('admin.siswa.create', compact('guru', 'instansi'));
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
            'kelas' => 'required|max:5',
            'jurusan' => 'required|max:50',
            'id_guru' => 'nullable|exists:guru,id_guru',
            'id_instansi' => 'nullable|exists:instansi,id_instansi',
        ]);

        // Gunakan transaction untuk memastikan data konsisten
        DB::beginTransaction();
        
        try {
            // STEP 1: Buat user dulu
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->nipd . '@sipkl.com',
                'password' => Hash::make($request->tgl_lahir), // Password = tanggal lahir
                'role' => 'siswa'
            ]);

            // STEP 2: Buat siswa dengan id dari user
            Siswa::create([
                'id' => $user->id,  // ID dari user yang baru dibuat
                'nipd' => $request->nipd,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'id_guru' => $request->id_guru,
                'id_instansi' => $request->id_instansi,
                'status_penempatan' => 'belum'
            ]);

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
        $guru = Guru::all();
        $instansi = Instansi::all();

        return view('admin.siswa.edit', compact('siswa', 'guru', 'instansi'));
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
            'kelas' => 'required|max:5',
            'jurusan' => 'required|max:50',
            'id_guru' => 'nullable|exists:guru,id_guru',
            'id_instansi' => 'nullable|exists:instansi,id_instansi',
        ]);

        DB::beginTransaction();
        
        try {
            // Update data siswa
            $siswa->update([
                'nipd' => $request->nipd,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'id_guru' => $request->id_guru,
                'id_instansi' => $request->id_instansi,
            ]);

            // Update juga data user
            $user = User::find($siswa->id);
            if ($user) {
                $user->update([
                    'name' => $request->nama,
                    'email' => $request->nipd . '@sipkl.com'
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
            // Hapus user dulu
            User::where('id', $siswa->id)->delete();
            
            // Baru hapus siswa
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