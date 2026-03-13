<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $query = Instansi::with('mentor', 'siswa', 'guru');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_instansi', 'like', '%' . $search . '%')
                  ->orWhere('pemilik', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('jurusan')) {
            $jurusan = $request->jurusan;
            $query->where(function($q) use ($jurusan) {
                $q->where('jurusan_diterima', $jurusan)
                  ->orWhere('jurusan_diterima', 'like', '%' . $jurusan . '%');
            });
        }

        if ($request->filled('sumber')) {
            if ($request->sumber === 'admin') {
                $query->where('is_from_submission', 0);
            } elseif ($request->sumber === 'pengajuan') {
                $query->where('is_from_submission', 1);
            }
        }

        if ($request->filled('kuota')) {
            if ($request->kuota === 'tersedia') {
                $query->whereRaw('kuota_terpakai < kuota_siswa');
            } elseif ($request->kuota === 'penuh') {
                $query->whereRaw('kuota_terpakai >= kuota_siswa');
            }
        }

        $instansi = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.instansi.index', compact('instansi'));
    }

    public function create()
    {
        $guru = Guru::orderBy('nama', 'asc')->get();
        
        return view('admin.instansi.create', compact('guru'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nama_instansi' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'no_hp' => 'required|string|max:13',
        'pemilik' => 'required|string|max:50',
        'kuota_siswa' => 'required|integer|min:1',
        'id_guru' => 'nullable|exists:guru,id_guru',
        'jurusan_diterima' => 'required|in:PPLG,BRP,DKV,PPLG-BRP,PPLG-DKV,BRP-DKV,PPLG-BRP-DKV',
    ]);

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
            'jurusan_diterima' => $validated['jurusan_diterima'],
        ]);

        $username = strtolower($validated['nama_instansi']);
        $username = preg_replace('/[^a-z0-9]+/', '_', $username);
        $username = trim($username, '_');

        if (strlen($username) > 20) {
            $username = substr($username, 0, 20);
        }
        
        $originalUsername = $username;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $originalUsername . '_' . $counter;
            $counter++;
        }

        $mentor = User::create([
            'name' => 'Mentor ' . $validated['nama_instansi'],
            'username' => $username,
            'email' => $username . '@sipkl.com',
            'password' => Hash::make('@mentor123'),
            'role' => 'mentor',
            'id_instansi' => $instansi->id_instansi,
        ]);

        DB::commit();

        return redirect()->route('admin.instansi.index')
            ->with('success', 'Data instansi berhasil ditambahkan! Akun mentor dibuat dengan username: ' . $username . ' dan password: @mentor123');

    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('Error creating instansi: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return back()->withInput()
            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        $guru = Guru::orderBy('nama', 'asc')->get();
        
        return view('admin.instansi.edit', compact('instansi', 'guru'));
    }

    public function update(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);
        $oldGuruId = $instansi->id_guru;

        $validated = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_hp' => 'required|string|max:13',
            'pemilik' => 'required|string|max:50',
            'kuota_siswa' => 'required|integer|min:1',
            'id_guru' => 'nullable|exists:guru,id_guru',
            'jurusan_diterima' => 'required|in:PPLG,BRP,DKV,PPLG-BRP,PPLG-DKV,BRP-DKV,PPLG-BRP-DKV',
        ]);

        if ($validated['kuota_siswa'] < $instansi->kuota_terpakai) {
            return back()->withInput()
                ->with('error', 'Kuota siswa tidak boleh lebih kecil dari kuota terpakai (' . $instansi->kuota_terpakai . ' siswa)!');
        }

        try {
            DB::beginTransaction();

            $instansi->update($validated);

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

    public function show($id)
    {
        $instansi = Instansi::with(['mentor', 'siswa', 'guru'])
            ->findOrFail($id);
        
        return view('admin.instansi.show', compact('instansi'));
    }
}