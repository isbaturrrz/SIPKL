<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreJurnalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jurnal;
use App\Models\Siswa;
use Carbon\Carbon;

class JurnalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->orderBy('tgl', 'desc')
            ->paginate(10);
        
        return view('siswa.jurnal.index', compact('jurnal', 'siswa'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $siswa = Siswa::with('instansi')
            ->where('id', $user->id)
            ->firstOrFail();
        
        if (!$siswa->instansi) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Anda belum memiliki instansi PKL. Silakan pilih instansi terlebih dahulu.');
        }
        
        $today = Carbon::today();
        $existingJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tgl', $today)
            ->first();
        
        if ($existingJurnal) {
            return redirect()->route('siswa.dashboard')
                ->with('error', 'Anda sudah mengisi jurnal hari ini');
        }
        
        return view('siswa.jurnal.create', compact('siswa'));
    }

   public function store(StoreJurnalRequest $request)
    {
        $user = Auth::user();
        $siswa = Siswa::with('instansi')->where('id', $user->id)->firstOrFail();
        
        $validated = $request->validated();
        
        if ($validated['status_kehadiran'] === 'wfo') {
            if (!$siswa->instansi) {
                return back()->with('error', 'Anda belum memiliki instansi PKL')->withInput();
            }
            
            $distance = $this->calculateDistance(
                $validated['latitude'],
                $validated['longitude'],
                $siswa->instansi->latitude,
                $siswa->instansi->longitude
            );
            
            if ($distance > 100) {
                return back()->with('error', 'Anda berada terlalu jauh dari lokasi instansi PKL (Jarak: ' . round($distance) . ' meter). Maksimal 100 meter.')->withInput();
            }
        }
        
        $existingJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tgl', $validated['tgl'])
            ->first();
        
        if ($existingJurnal) {
            return back()->with('error', 'Anda sudah mengisi jurnal untuk tanggal ' . Carbon::parse($validated['tgl'])->format('d/m/Y'))->withInput();
        }
        
        $dataJurnal = [
            'id_siswa' => $siswa->id_siswa,
            'tgl' => $validated['tgl'],
            'jam_mulai' => $validated['jam_mulai'] ?? null,
            'jam_selesai' => $validated['jam_selesai'] ?? null,
            'status_kehadiran' => $validated['status_kehadiran'],
            'kegiatan' => $validated['kegiatan'] ?? null,
            'manfaat' => $validated['manfaat'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'input_by' => 'siswa',
            'status_verifikasi' => 'pending',
        ];
        
        Jurnal::create($dataJurnal);
        
        return redirect()->route('siswa.dashboard')
            ->with('success', 'Jurnal berhasil disimpan dan menunggu verifikasi');
    }

    public function show($id)
    {
        $user = Auth::user();
        $siswa = Siswa::where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_jurnal', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();
        
        return view('siswa.jurnal.show', compact('jurnal', 'siswa'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $siswa = Siswa::with('instansi')->where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_jurnal', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();
        
        if ($jurnal->status_verifikasi !== 'pending') {
            return redirect()->route('siswa.jurnal.index')
                ->with('error', 'Jurnal yang sudah diverifikasi tidak dapat diedit');
        }
        
        return view('siswa.jurnal.edit', compact('jurnal', 'siswa'));
    }

    public function update(StoreJurnalRequest $request, $id)
    {
        $user = Auth::user();
        $siswa = Siswa::with('instansi')->where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_jurnal', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();
        
        if ($jurnal->status_verifikasi !== 'pending') {
            return back()->with('error', 'Jurnal yang sudah diverifikasi tidak dapat diedit');
        }
        
        $validated = $request->validated();
        
        if ($request->wfh == 1) {
            $distance = $this->calculateDistance(
                $validated['latitude'],
                $validated['longitude'],
                $siswa->instansi->latitude,
                $siswa->instansi->longitude
            );
            
            if ($distance > 100) {
                return back()->with('error', 'Anda berada terlalu jauh dari lokasi instansi PKL (Jarak: ' . round($distance) . ' meter)')->withInput();
            }
        }
        
        $jurnal->update($validated);
        
        return redirect()->route('siswa.jurnal.index')
            ->with('success', 'Jurnal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $siswa = Siswa::where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_jurnal', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();
        
        if ($jurnal->status_verifikasi !== 'pending') {
            return back()->with('error', 'Jurnal yang sudah diverifikasi tidak dapat dihapus');
        }
        
        $jurnal->delete();
        
        return redirect()->route('siswa.jurnal.index')
            ->with('success', 'Jurnal berhasil dihapus');
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;
        
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        
        return $angle * $earthRadius;
    }
}