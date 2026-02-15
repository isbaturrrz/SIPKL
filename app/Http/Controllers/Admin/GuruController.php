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
    public function index()
    {
        $guru = Guru::with('instansi')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $instansi = Instansi::whereNull('id_guru')
                        ->orderBy('nama_instansi', 'asc')
                        ->get();
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
                'id_instansi' => 'nullable|exists:instansi,id_instansi',
            ]);

            if ($request->id_instansi) {
                $instansi = Instansi::find($request->id_instansi);
                if ($instansi && $instansi->id_guru) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Instansi "' . $instansi->nama_instansi . '" sudah memiliki guru pembimbing!');
                }
            }

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
                'id_instansi' => $request->id_instansi,
            ]);

            Log::info('Guru berhasil dibuat', ['guru_id' => $guru->id_guru]);

            if ($request->id_instansi) {
                Instansi::where('id_instansi', $request->id_instansi)
                        ->update(['id_guru' => $guru->id_guru]);
            }

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

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $instansi = Instansi::where(function($query) use ($id) {
                    $query->whereNull('id_guru')
                          ->orWhere('id_guru', $id);
                })
                ->orderBy('nama_instansi', 'asc')
                ->get();
        return view('admin.guru.edit', compact('guru', 'instansi'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $oldInstansiId = $guru->id_instansi;

        try {
            $validated = $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|email|max:50|unique:users,email,' . $guru->id,
                'tempat_lahir' => 'required|max:50',
                'tgl_lahir' => 'required|date',
                'no_hp' => 'required|max:13',
                'id_instansi' => 'nullable|exists:instansi,id_instansi',
            ]);

            if ($request->id_instansi && $request->id_instansi != $oldInstansiId) {
                $instansi = Instansi::find($request->id_instansi);
                if ($instansi && $instansi->id_guru && $instansi->id_guru != $id) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Instansi "' . $instansi->nama_instansi . '" sudah memiliki guru pembimbing lain!');
                }
            }

            DB::beginTransaction();
            
            $guru->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'id_instansi' => $request->id_instansi,
            ]);

            $user = User::find($guru->id);
            if ($user) {
                $user->update([
                    'name' => $request->nama,
                    'username' => $request->email,
                    'email' => $request->email,
                ]);
            }

            if ($oldInstansiId && $oldInstansiId != $request->id_instansi) {
                Instansi::where('id_instansi', $oldInstansiId)
                        ->update(['id_guru' => null]);
            }

            if ($request->id_instansi) {
                Instansi::where('id_instansi', $request->id_instansi)
                        ->update(['id_guru' => $id]);
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
            $guru = Guru::findOrFail($id);
            
            DB::beginTransaction();

            if ($guru->id_instansi) {
                Instansi::where('id_instansi', $guru->id_instansi)
                        ->update(['id_guru' => null]);
            }
            
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