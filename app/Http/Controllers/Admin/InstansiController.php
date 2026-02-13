<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InstansiController extends Controller
{
    public function index()
    {
        $instansi = Instansi::with('mentor', 'siswa', 'guru')->orderBy('created_at', 'desc')->get();
        
        return view('admin.instansi.index', compact('instansi'));
    }

    public function create()
    {
        $guru = Guru::whereNull('id_instansi')
                ->orderBy('nama', 'asc')
                ->get();
        
        return view('admin.instansi.create', compact('guru'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_instansi' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_hp' => 'required|string|max:13',
            'pemilik' => 'required|string|max:50',
            'kuota_siswa' => 'required|integer|min:1',
            'id_guru' => 'nullable|exists:guru,id_guru',
        ]);

        if ($request->id_guru) {
            $guru = Guru::find($request->id_guru);
            if ($guru && $guru->id_instansi) {
                return back()->withInput()
                    ->with('error', 'Guru "' . $guru->nama . '" sudah membimbing instansi lain!');
            }
        }

        try {
            DB::beginTransaction();

            $instansi = Instansi::create([
                'nama_instansi' => $validated['nama_instansi'],
                'alamat' => $validated['alamat'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'no_hp' => $validated['no_hp'],
                'pemilik' => $validated['pemilik'],
                'kuota_siswa' => $validated['kuota_siswa'],
                'kuota_terpakai' => 0,
                'is_from_submission' => 0,
                'id_guru' => $validated['id_guru'],
            ]);

            $username = strtolower($validated['nama_instansi']);
            $username = preg_replace('/[^a-z0-9]+/', '_', $username);
            $username = trim($username, '_');
            
            $originalUsername = $username;
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $originalUsername . '_' . $counter;
                $counter++;
            }

            User::create([
                'name' => 'Mentor ' . $validated['nama_instansi'],
                'username' => $username,
                'email' => null,
                'password' => Hash::make('@mentor123'),
                'role' => 'mentor',
                'id_instansi' => $instansi->id_instansi,
            ]);

            if ($request->id_guru) {
                Guru::where('id_guru', $request->id_guru)
                    ->update(['id_instansi' => $instansi->id_instansi]);
            }

            DB::commit();

            return redirect()->route('admin.instansi.index')
                ->with('success', 'Data instansi berhasil ditambahkan! Akun mentor dibuat dengan username: ' . $username . ' dan password: @mentor123');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        $guru = Guru::where(function($query) use ($id) {
                $query->whereNull('id_instansi')
                      ->orWhere('id_instansi', $id);
            })
            ->orderBy('nama', 'asc')
            ->get();
        
        return view('admin.instansi.edit', compact('instansi', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);
        $oldGuruId = $instansi->id_guru;

        $validated = $request->validate([
            'nama_instansi' => 'required|string|max:50',
            'alamat' => 'required|string|max:50',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_hp' => 'required|string|max:13',
            'pemilik' => 'required|string|max:50',
            'kuota_siswa' => 'required|integer|min:1',
            'id_guru' => 'nullable|exists:guru,id_guru',
        ]);

        if ($validated['kuota_siswa'] < $instansi->kuota_terpakai) {
            return back()->withInput()
                ->with('error', 'Kuota siswa tidak boleh lebih kecil dari kuota terpakai (' . $instansi->kuota_terpakai . ' siswa)!');
        }

        if ($request->id_guru && $request->id_guru != $oldGuruId) {
            $guru = Guru::find($request->id_guru);
            if ($guru && $guru->id_instansi && $guru->id_instansi != $id) {
                return back()->withInput()
                    ->with('error', 'Guru "' . $guru->nama . '" sudah membimbing instansi lain!');
            }
        }

        try {
            DB::beginTransaction();

            $instansi->update($validated);

            if ($oldGuruId && $oldGuruId != $request->id_guru) {
                Guru::where('id_guru', $oldGuruId)
                    ->update(['id_instansi' => null]);
            }

            if ($request->id_guru) {
                Guru::where('id_guru', $request->id_guru)
                    ->update(['id_instansi' => $id]);
            }

            DB::commit();

            return redirect()->route('admin.instansi.index')
                ->with('success', 'Data instansi berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $instansi = Instansi::findOrFail($id);
            
            if ($instansi->kuota_terpakai > 0 || $instansi->siswa()->count() > 0) {
                return back()->with('error', 'Tidak dapat menghapus instansi yang masih memiliki siswa!');
            }

            if ($instansi->id_guru) {
                Guru::where('id_guru', $instansi->id_guru)
                    ->update(['id_instansi' => null]);
            }

            User::where('id_instansi', $id)->where('role', 'mentor')->delete();

            $instansi->delete();

            DB::commit();

            return redirect()->route('admin.instansi.index')
                ->with('success', 'Data instansi dan akun mentor berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}