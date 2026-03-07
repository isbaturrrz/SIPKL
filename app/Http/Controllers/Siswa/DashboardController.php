<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Services\StreakService;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $streakService;

    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }

    public function index()
    {
        $user = Auth::user();

        $siswa = Siswa::with(['instansi', 'guru'])
            ->where('id', $user->id)
            ->firstOrFail();
        
        $data = [
            'siswa' => $siswa,
            'nama' => $siswa->nama,
            'kelas_lengkap' => $siswa->kelas_lengkap,
            'jurusan_lengkap' => $siswa->jurusan_lengkap,
            'instansi_nama' => $siswa->instansi->nama_instansi ?? 'Belum ada instansi',
            'instansi_alamat' => $siswa->instansi->alamat ?? 'Alamat belum tersedia',
            'has_instansi' => $siswa->instansi !== null,
        ];

        $nama = $siswa->nama;
        $kelas_lengkap = $siswa->kelas_lengkap ?? '-';
        $jurusan_lengkap = $siswa->jurusan_lengkap ?? '-';
        
        $has_instansi = $siswa->instansi !== null;
        $instansi_nama = $has_instansi ? $siswa->instansi->nama_instansi : null;
        $instansi_alamat = $has_instansi ? $siswa->instansi->alamat : null;

        $streakData = $this->streakService->getStreakData($siswa->id_siswa);
        $calendarData = $this->streakService->getCalendarData($siswa->id_siswa);

        foreach ($calendarData as $day) {
            Log::info('Calendar Day: ' . $day['date'] . ' - has_journal: ' . ($day['has_journal'] ? 'true' : 'false') . ' - is_alfa: ' . ($day['is_alfa'] ? 'true' : 'false'));
        }
        
        return view('siswa.dashboard', compact(
            'data',
            'nama',
            'kelas_lengkap',
            'jurusan_lengkap',
            'has_instansi',
            'instansi_nama',
            'instansi_alamat',
            'streakData',
            'calendarData'
        ));
    }
}