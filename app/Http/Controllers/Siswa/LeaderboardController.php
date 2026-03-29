<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Services\StreakService;

class LeaderboardController extends Controller
{
    protected $streakService;

    public function __construct(StreakService $streakService)
    {
        $this->streakService = $streakService;
    }

    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::with('instansi')->where('id', $user->id)->firstOrFail();

        if (!$siswa->id_instansi) {
            return redirect()->route('siswa.jurnal.index')
                ->with('error', 'Anda belum memiliki instansi PKL. Silakan pilih instansi terlebih dahulu.');
        }

        $leaderboard = $this->streakService->getLeaderboardInstansi(
            $siswa->id_instansi,
            10,
            $siswa->id_siswa
        );

        $myRank = $this->streakService->getPersonalRank(
            $siswa->id_siswa,
            'instansi',
            $siswa->id_instansi
        );

        $myPoin = $this->streakService->calculateTotalPoin($siswa->id_siswa);
        
        $consistencyRate = $this->streakService->calculateConsistencyRate($siswa->id_siswa);

        $instansiNama = $siswa->instansi->nama_instansi ?? 'Instansi PKL';

        return view('siswa.leaderboard.index', compact(
            'leaderboard',
            'myRank',
            'myPoin',
            'consistencyRate',
            'instansiNama'
        ));
    }
}