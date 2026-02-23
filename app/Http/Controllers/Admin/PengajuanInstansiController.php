<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\PengajuanInstansi;
use App\Models\Instansi;
use App\Models\Siswa;
use App\Models\User;

class PengajuanInstansiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pengajuan = PengajuanInstansi::with('siswa')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_perusahaan', 'like', "%{$search}%")
                      ->orWhereHas('siswa', function ($q) use ($search) {
                          $q->where('nama', 'like', "%{$search}%");
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $pengajuan->appends(['search' => $search]);

        return view('admin.pengajuan-instansi.index', compact('pengajuan', 'search'));
    }

    public function show($id)
    {
        $pengajuan = PengajuanInstansi::with('siswa')->findOrFail($id);
        return view('admin.pengajuan-instansi.show', compact('pengajuan'));
    }

    public function approve($id)
    {
        DB::beginTransaction();

        try {
            $pengajuan = PengajuanInstansi::with('siswa')->findOrFail($id);

            if ($pengajuan->status !== 'pending') {
                return redirect()->back()
                    ->with('error', 'Pengajuan sudah diproses sebelumnya');
            }

            $instansi = Instansi::create([
                'nama_instansi' => $pengajuan->nama_perusahaan,
                'alamat' => $pengajuan->alamat,
                'latitude' => $pengajuan->latitude,
                'longitude' => $pengajuan->longitude,
                'no_hp' => $pengajuan->no_hp,
                'pemilik' => $pengajuan->pemilik,
                'kuota_siswa' => $pengajuan->kuota_siswa,
                'kuota_terpakai' => 1,
                'is_from_submission' => 1,
                'jurusan_diterima' => $pengajuan->jurusan_diterima,
            ]);

            $username = strtolower($pengajuan->nama_perusahaan);
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

            User::create([
                'name' => 'Mentor ' . $pengajuan->nama_perusahaan,
                'username' => $username,
                'email' => $username . '@sipkl.com',
                'password' => Hash::make('@mentor123'),
                'role' => 'mentor',
                'id_instansi' => $instansi->id_instansi,
            ]);

            Siswa::where('id_siswa', $pengajuan->id_siswa)->update([
                'id_instansi' => $instansi->id_instansi,
                'status_penempatan' => 'sudah',
            ]);

            $pengajuan->update([
                'status' => 'approved',
            ]);

            DB::commit();

            return redirect()->route('admin.pengajuan-instansi.index')
                ->with('success', 'Pengajuan berhasil disetujui. Instansi dan akun mentor telah dibuat.');

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error approving pengajuan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan_reject' => 'required|string|max:255',
        ], [
            'keterangan_reject.required' => 'Alasan penolakan wajib diisi',
        ]);

        try {
            $pengajuan = PengajuanInstansi::findOrFail($id);

            if ($pengajuan->status !== 'pending') {
                return redirect()->back()
                    ->with('error', 'Pengajuan sudah diproses sebelumnya');
            }

            $pengajuan->update([
                'status' => 'rejected',
                'keterangan_reject' => $request->keterangan_reject,
            ]);

            return redirect()->route('admin.pengajuan-instansi.index')
                ->with('success', 'Pengajuan berhasil ditolak');

        } catch (\Exception $e) {
            Log::error('Error rejecting pengajuan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}