<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::with(['instansi', 'siswa']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%')
                  ->orWhere('tempat_lahir', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('instansi')) {
            if ($request->instansi === 'ada') {
                $query->has('instansi');
            } elseif ($request->instansi === 'kosong') {
                $query->doesntHave('instansi');
            }
        }

        $guru = $query->orderBy('nama', 'asc')->paginate(10);
        
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $instansi = Instansi::orderBy('nama_instansi', 'asc')->get();
        return view('admin.guru.create', compact('instansi'));
    }

    public function store(Request $request)
    {
        Log::info('Request masuk ke store guru', $request->all());
        
        try {
            $validated = $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|email|unique:users,email|max:50',
                'tempat_lahir' => 'required|max:50',
                'tgl_lahir' => 'required|date',
                'no_hp' => 'required|max:13',
            ]);

            Log::info('Validasi berhasil', $validated);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->nama,
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->tgl_lahir),
                'role' => 'guru'
            ]);

            Log::info('User berhasil dibuat', ['user_id' => $user->id]);

            $guru = Guru::create([
                'id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
            ]);

            Log::info('Guru berhasil dibuat', ['guru_id' => $guru->id_guru]);

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil ditambahkan!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal', ['errors' => $e->errors()]);
            
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
                
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saat menyimpan guru', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $guru = Guru::with(['instansi', 'siswa' => function($query) {
            $query->with('instansi');
        }])->findOrFail($id);
        
        return view('admin.guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::with(['instansi', 'siswa'])->findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        try {
            $validated = $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|email|max:50|unique:users,email,' . $guru->id,
                'tempat_lahir' => 'required|max:50',
                'tgl_lahir' => 'required|date',
                'no_hp' => 'required|max:13',
            ]);

            DB::beginTransaction();
            
            $guru->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
            ]);

            $user = User::find($guru->id);
            if ($user) {
                $userUpdateData = [
                    'name' => $request->nama,
                    'username' => $request->email,
                    'email' => $request->email,
                ];

                if ($guru->tgl_lahir != $request->tgl_lahir) {
                    $userUpdateData['password'] = Hash::make($request->tgl_lahir);
                    Log::info('Password diupdate karena tgl_lahir berubah', ['guru_id' => $guru->id]);
                }

                $user->update($userUpdateData);
            }

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil diupdate!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
                
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saat update guru', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guru = Guru::with(['instansi', 'siswa'])->findOrFail($id);
            
            if ($guru->instansi()->count() > 0) {
                return back()->with('error', 'Tidak dapat menghapus guru yang masih membimbing ' . $guru->instansi()->count() . ' instansi!');
            }

            if ($guru->siswa()->count() > 0) {
                return back()->with('error', 'Tidak dapat menghapus guru yang masih membimbing siswa!');
            }
            
            DB::beginTransaction();
            
            User::where('id', $guru->id)->delete();
            
            $guru->delete();

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saat hapus guru', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}