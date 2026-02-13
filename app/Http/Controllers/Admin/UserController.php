<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'guru', 'mentor'])->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:50',
                'username' => 'required|max:50|unique:users,username',
                'email' => 'required|email|unique:users,email|max:50',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:admin,guru,siswa,',
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan user', [
                'message' => $e->getMessage(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan user: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|max:50',
                'username' => 'required|max:50|unique:users,username,' . $id,
                'email' => 'required|email|max:50|unique:users,email,' . $id,
                'role' => 'required|in:admin,guru,siswa,',
                'password' => 'nullable|min:6|confirmed',
            ]);

            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->role,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil diupdate!');
                
        } catch (\Exception $e) {
            Log::error('Error saat update user', [
                'message' => $e->getMessage(),
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            if ($user->id == Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

            $user->delete();

            return redirect()->route('admin.user.index')
                ->with('success', 'User berhasil dihapus!');
                
        } catch (\Exception $e) {
            Log::error('Error saat hapus user', [
                'message' => $e->getMessage(),
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}