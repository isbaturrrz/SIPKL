<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\StoreJurnalRequest;
use App\Http\Requests\Siswa\UpdateJurnalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Jurnal;
use App\Models\Siswa;
use Carbon\Carbon;
use App\Services\StreakService;

class JurnalController extends Controller
{
    protected $streakService;

    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('id', $user->id)->firstOrFail();
    
        $query = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->orderBy('tgl', 'desc');
    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tgl', 'like', '%' . $search . '%')
                  ->orWhere('status_kehadiran', 'like', '%' . $search . '%');
            });
        }
    
        $jurnal = $query->paginate(10);

        $jurnalRejected = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->where('status_verifikasi', 'rejected')
            ->orderBy('tgl', 'desc')
            ->get();
    
        return view('siswa.jurnal.index', compact('jurnal', 'siswa', 'jurnalRejected'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $siswa = Siswa::with('instansi')
            ->where('id', $user->id)
            ->firstOrFail();
        
        if (!$siswa->instansi) {
            return redirect()->route('siswa.jurnal.index')
                ->with('error', 'Anda belum memiliki instansi PKL. Silakan pilih instansi terlebih dahulu.');
        }
        
        $today = Carbon::today();
        $existingJurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
            ->whereDate('tgl', $today)
            ->first();
        
        if ($existingJurnal) {
            return redirect()->route('siswa.jurnal.index')
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
        
        $fotoPath = null;
        if ($request->hasFile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $filename = 'jurnal_' . $siswa->id_siswa . '_' . time() . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('jurnal_foto', $filename, 'public');
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
            'foto_kegiatan' => $fotoPath,
            'input_by' => 'siswa',
            'status_verifikasi' => 'pending',
        ];
        
        Jurnal::create($dataJurnal);

        $this->streakService->clearCache($siswa->id_siswa);
    
        $totalPoin = $this->streakService->calculateTotalPoin($siswa->id_siswa);
    
        return redirect()->route('siswa.jurnal.index')
            ->with('success', "Jurnal berhasil disimpan! Total poin: {$totalPoin} 🔥");     
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
        
        if (!in_array($jurnal->status_verifikasi, ['pending', 'rejected'])) {
            return redirect()->route('siswa.jurnal.index')
                ->with('error', 'Jurnal yang sudah diverifikasi tidak dapat diedit');
        }
        
        return view('siswa.jurnal.edit', compact('jurnal', 'siswa'));
    }

    public function update(UpdateJurnalRequest $request, $id)
    {
        $user = Auth::user();
        $siswa = Siswa::with('instansi')->where('id', $user->id)->firstOrFail();
        
        $jurnal = Jurnal::where('id_jurnal', $id)
            ->where('id_siswa', $siswa->id_siswa)
            ->firstOrFail();
        
        if (!in_array($jurnal->status_verifikasi, ['pending', 'rejected'])) {
            return back()->with('error', 'Jurnal yang sudah diverifikasi tidak dapat diedit');
        }
        
        $validated = $request->validated();
        
        if ($validated['status_kehadiran'] === 'wfo') {
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
        
        if ($request->hasFile('foto_kegiatan')) {
            if ($jurnal->foto_kegiatan && Storage::disk('public')->exists($jurnal->foto_kegiatan)) {
                Storage::disk('public')->delete($jurnal->foto_kegiatan);
            }
            
            $file = $request->file('foto_kegiatan');
            $filename = 'jurnal_' . $siswa->id_siswa . '_' . time() . '.' . $file->getClientOriginalExtension();
            $validated['foto_kegiatan'] = $file->storeAs('jurnal_foto', $filename, 'public');
        }
        
        $updateData = $validated;
        
        if ($jurnal->status_verifikasi === 'rejected') {
            $updateData['status_verifikasi'] = 'pending';
        }
        
        $jurnal->update($updateData);
        
        $message = $jurnal->wasChanged('status_verifikasi') 
            ? 'Jurnal berhasil diperbarui dan diajukan kembali untuk verifikasi' 
            : 'Jurnal berhasil diperbarui';
        
        return redirect()->route('siswa.jurnal.index')
            ->with('success', $message);
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
        
        if ($jurnal->foto_kegiatan && Storage::disk('public')->exists($jurnal->foto_kegiatan)) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
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