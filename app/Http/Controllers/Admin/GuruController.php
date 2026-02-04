<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:users,email|max:50',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|max:13',
        ]);

        DB::beginTransaction();
        
        try {
            // STEP 1: Buat user dulu
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->tgl_lahir), // Password = tanggal lahir
                'role' => 'guru'
            ]);

            // STEP 2: Buat guru dengan id dari user
            Guru::create([
                'id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $guru->id,
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|max:13',
        ]);

        DB::beginTransaction();
        
        try {
            // Update guru
            $guru->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
            ]);

            // Update user juga
            $user = User::find($guru->id);
            if ($user) {
                $user->update([
                    'name' => $request->nama,
                    'email' => $request->email,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil diupdate!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        
        DB::beginTransaction();
        
        try {
            // Hapus user dulu
            User::where('id', $guru->id)->delete();
            
            // Baru hapus guru
            $guru->delete();

            DB::commit();

            return redirect()->route('admin.guru.index')
                ->with('success', 'Data guru berhasil dihapus!');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}