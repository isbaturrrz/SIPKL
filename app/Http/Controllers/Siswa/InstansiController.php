<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use App\Models\Instansi;
use App\Models\PengajuanInstansi;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            $siswa = Siswa::where('id', $user->id)->first();

            if (!$siswa) {
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Data siswa tidak ditemukan');
            }

            $search = $request->search;

            $instansiList = Instansi::with('guru')
                ->whereRaw('kuota_terpakai < kuota_siswa')
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_instansi', 'like', "%{$search}%")
                          ->orWhere('alamat', 'like', "%{$search}%");
                })
                ->orderBy('nama_instansi', 'asc')
                ->get();

            foreach ($instansiList as $instansi) {
                $instansi->jurusan_match = $this->checkJurusanMatch($siswa->jurusan, $instansi->jurusan_diterima);
            }

            $hasInstansi = !empty($siswa->id_instansi);

            $pengajuanPending = PengajuanInstansi::where('id_siswa', $siswa->id_siswa)
                ->where('status', 'pending')
                ->first();

            $pengajuanRejected = PengajuanInstansi::where('id_siswa', $siswa->id_siswa)
                ->where('status', 'rejected')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('siswa.instansi.index', compact(
                'siswa',
                'instansiList',
                'hasInstansi',
                'pengajuanPending',
                'pengajuanRejected',
                'search'
            ));

        } catch (\Exception $e) {
            Log::error('Error in InstansiController@index: ' . $e->getMessage());
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function create()
    {
        try {
            $user = Auth::user();
            $siswa = Siswa::where('id', $user->id)->first();

            if (!$siswa) {
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Data siswa tidak ditemukan');
            }

            if (!empty($siswa->id_instansi)) {
                return redirect()->route('siswa.instansi.index')
                    ->with('error', 'Anda sudah memiliki instansi PKL');
            }

            $pengajuanPending = PengajuanInstansi::where('id_siswa', $siswa->id_siswa)
                ->where('status', 'pending')
                ->exists();

            if ($pengajuanPending) {
                return redirect()->route('siswa.instansi.index')
                    ->with('error', 'Anda masih memiliki pengajuan yang sedang diproses');
            }

            return view('siswa.instansi.create', compact('siswa'));

        } catch (\Exception $e) {
            Log::error('Error in InstansiController@create: ' . $e->getMessage());
            return redirect()->route('siswa.instansi.index')
                ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'no_hp' => 'required|max:13',
            'pemilik' => 'required|max:50',
            'kuota_siswa' => 'required|integer|min:1|max:50',
            'jurusan_diterima' => 'required|in:PPLG,BRP,DKV,PPLG-BRP,PPLG-DKV,BRP-DKV,PPLG-BRP-DKV',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi',
            'nama_perusahaan.max' => 'Nama perusahaan maksimal 255 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'longitude.numeric' => 'Longitude harus berupa angka',
            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.max' => 'No HP maksimal 13 karakter',
            'pemilik.required' => 'Nama pemilik wajib diisi',
            'pemilik.max' => 'Nama pemilik maksimal 50 karakter',
            'kuota_siswa.required' => 'Kuota siswa wajib diisi',
            'kuota_siswa.integer' => 'Kuota siswa harus berupa angka',
            'kuota_siswa.min' => 'Kuota siswa minimal 1',
            'kuota_siswa.max' => 'Kuota siswa maksimal 50',
            'jurusan_diterima.required' => 'Jurusan yang diterima wajib dipilih',
            'jurusan_diterima.in' => 'Jurusan yang dipilih tidak valid',
        ]);

        try {
            $user = Auth::user();
            $siswa = Siswa::where('id', $user->id)->first();

            if (!$siswa) {
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Data siswa tidak ditemukan');
            }

            if (!empty($siswa->id_instansi)) {
                return redirect()->route('siswa.instansi.index')
                    ->with('error', 'Anda sudah memiliki instansi PKL');
            }

            $pengajuanPending = PengajuanInstansi::where('id_siswa', $siswa->id_siswa)
                ->where('status', 'pending')
                ->exists();

            if ($pengajuanPending) {
                return redirect()->route('siswa.instansi.index')
                    ->with('error', 'Anda masih memiliki pengajuan yang sedang diproses');
            }

            PengajuanInstansi::create([
                'id_siswa' => $siswa->id_siswa,
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'no_hp' => $request->no_hp,
                'pemilik' => $request->pemilik,
                'kuota_siswa' => $request->kuota_siswa,
                'jurusan_diterima' => $request->jurusan_diterima,
                'status' => 'pending',
            ]);

            return redirect()->route('siswa.instansi.index')
                ->with('success', 'Pengajuan instansi berhasil dikirim. Menunggu verifikasi admin.');

        } catch (\Exception $e) {
            Log::error('Error in InstansiController@store: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pilih($id)
    {
        DB::beginTransaction();

        try {
            $user = Auth::user();
            $siswa = Siswa::where('id', $user->id)->first();

            if (!$siswa) {
                return redirect()->route('siswa.dashboard')
                    ->with('error', 'Data siswa tidak ditemukan');
            }

            if (!empty($siswa->id_instansi)) {
                return redirect()->route('siswa.instansi.index')
                    ->with('error', 'Anda sudah memiliki instansi PKL');
            }

            $instansi = Instansi::findOrFail($id);

            if ($instansi->kuota_terpakai >= $instansi->kuota_siswa) {
                return redirect()->back()
                    ->with('error', 'Kuota instansi sudah penuh');
            }

            if (!$this->checkJurusanMatch($siswa->jurusan, $instansi->jurusan_diterima)) {
                return redirect()->back()
                    ->with('error', 'Jurusan Anda (' . $siswa->jurusan . ') tidak sesuai dengan jurusan yang diterima di instansi ini');
            }

            $siswa->update([
                'id_instansi' => $instansi->id_instansi,
                'id_guru' => $instansi->id_guru,
                'status_penempatan' => 'sudah',
            ]);

            Instansi::where('id_instansi', $instansi->id_instansi)
                ->increment('kuota_terpakai');

            DB::commit();

            return redirect()->route('siswa.dashboard')
                ->with('success', 'Berhasil memilih instansi: ' . $instansi->nama_instansi);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error in InstansiController@pilih: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    private function checkJurusanMatch($jurusanSiswa, $jurusanDiterima)
    {
        if (empty($jurusanDiterima)) {
            return true;
        }

        $jurusanArray = explode('-', $jurusanDiterima);
        
        return in_array($jurusanSiswa, $jurusanArray);
    }
}