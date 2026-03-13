<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class StreakService
{
    const CACHE_TTL = 300;
    const FIRE_OFF = 'off';
    const FIRE_ON = 'on';
    const FIRE_HOT = 'hot';
    const FIRE_LEGENDARY = 'legendary';

    public function calculateTotalPoin(int $siswaId): int
    {
        return DB::table('jurnal')
            ->where('id_siswa', $siswaId)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->where('status_kehadiran', '!=', 'alfa')
            ->distinct()
            ->count(DB::raw('DATE(tgl)'));
    }

    public function hasJournalToday(int $siswaId): bool
    {
        return DB::table('jurnal')
            ->where('id_siswa', $siswaId)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->where('status_kehadiran', '!=', 'alfa')
            ->whereDate('tgl', Carbon::today())
            ->exists();
    }

    public function getStreakData(int $siswaId): array
    {
        $cacheKey = "streak_siswa_{$siswaId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($siswaId) {
            $totalPoin = $this->calculateTotalPoin($siswaId);
            $hasToday = $this->hasJournalToday($siswaId);
            $fireStatus = $this->getFireStatus($totalPoin, $hasToday);
            $consistencyRate = $this->calculateConsistencyRate($siswaId);

            return [
                'total_poin' => $totalPoin,
                'has_journal_today' => $hasToday,
                'fire_status' => $fireStatus,
                'consistency_rate' => $consistencyRate,
            ];
        });
    }

    public function getFireStatus(int $totalPoin, bool $hasToday): string
    {
        if (!$hasToday) {
            return self::FIRE_OFF;
        }

        if ($totalPoin >= 90) {
            return self::FIRE_LEGENDARY;
        } elseif ($totalPoin >= 30) {
            return self::FIRE_HOT;
        } else {
            return self::FIRE_ON;
        }
    }

    public function calculateConsistencyRate(int $siswaId, int $days = 30): int
    {
        $firstJournalDate = DB::table('jurnal')
            ->where('id_siswa', $siswaId)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->where('status_kehadiran', '!=', 'alfa')
            ->min(DB::raw('DATE(tgl)'));

        if (!$firstJournalDate) {
            return 0;
        }

        $startDate = Carbon::parse($firstJournalDate);
        $today = Carbon::today();
        
        $totalDays = $startDate->diffInDays($today) + 1;
        $totalDays = min($totalDays, $days);

        $filledDays = DB::table('jurnal')
            ->where('id_siswa', $siswaId)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->where('status_kehadiran', '!=', 'alfa')
            ->where('tgl', '>=', $today->copy()->subDays($days))
            ->distinct()
            ->count(DB::raw('DATE(tgl)'));

        if ($totalDays == 0) {
            return 0;
        }

        return round(($filledDays / $totalDays) * 100);
    }

    public function getCalendarData(int $siswaId): array
    {
        $days = [];
        $today = Carbon::today();

        $journalData = DB::table('jurnal')
            ->where('id_siswa', $siswaId)
            ->whereIn('status_verifikasi', ['verified', 'pending'])
            ->whereBetween('tgl', [
                $today->copy()->subDays(6)->startOfDay(),
                $today->copy()->endOfDay()
            ])
            ->select(DB::raw('DATE(tgl) as date'), 'status_kehadiran')
            ->get()
            ->keyBy(fn($item) => Carbon::parse($item->date)->format('Y-m-d'));

        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            
            $journal = $journalData->get($dateStr);
            
            $hasJournal = false;
            $isAlfa = false;
            
            if ($journal !== null) {
                if ($journal->status_kehadiran === 'alfa') {
                    $isAlfa = true;
                } else {
                    $hasJournal = true;
                }
            }
            
            $days[] = [
                'date' => $dateStr,
                'day_name' => $this->getDayNameIndo($date->dayOfWeek),
                'has_journal' => $hasJournal,
                'is_alfa' => $isAlfa,
                'is_today' => $date->isToday(),
            ];
        }

        return $days;
    }

    protected function getDayNameIndo(int $dayOfWeek): string
    {
        $days = ['M', 'S', 'S', 'R', 'K', 'J', 'S'];
        return $days[$dayOfWeek];
    }

    public function getLeaderboardKelas(string $kelas, string $jurusan, int $rombel, int $limit = 20, ?int $currentSiswaId = null): array
    {
        $leaderboard = DB::table('jurnal')
            ->join('siswa', 'jurnal.id_siswa', '=', 'siswa.id_siswa')
            ->where('siswa.kelas', $kelas)
            ->where('siswa.jurusan', $jurusan)
            ->where('siswa.rombel', $rombel)
            ->whereIn('jurnal.status_verifikasi', ['verified', 'pending'])
            ->where('jurnal.status_kehadiran', '!=', 'alfa')
            ->select(
                'siswa.id_siswa',
                'siswa.nama',
                'siswa.kelas',
                'siswa.jurusan',
                'siswa.rombel',
                DB::raw('CONCAT(siswa.kelas, " ", siswa.jurusan, " ", siswa.rombel) as kelas_lengkap'),
                DB::raw('COUNT(DISTINCT DATE(jurnal.tgl)) as poin')
            )
            ->groupBy('siswa.id_siswa', 'siswa.nama', 'siswa.kelas', 'siswa.jurusan', 'siswa.rombel')
            ->orderBy('poin', 'DESC')
            ->limit($limit)
            ->get()
            ->map(function ($item, $index) use ($currentSiswaId) {
                return [
                    'rank' => $index + 1,
                    'id_siswa' => $item->id_siswa,
                    'nama' => $item->nama,
                    'kelas' => $item->kelas_lengkap,
                    'poin' => $item->poin,
                    'is_me' => $item->id_siswa == $currentSiswaId,
                ];
            })
            ->toArray();

        return $leaderboard;
    }

    public function getLeaderboardJurusan(string $jurusan, int $limit = 20, ?int $currentSiswaId = null): array
    {
        $leaderboard = DB::table('jurnal')
            ->join('siswa', 'jurnal.id_siswa', '=', 'siswa.id_siswa')
            ->where('siswa.jurusan', $jurusan)
            ->whereIn('jurnal.status_verifikasi', ['verified', 'pending'])
            ->where('jurnal.status_kehadiran', '!=', 'alfa')
            ->select(
                'siswa.id_siswa',
                'siswa.nama',
                'siswa.kelas',
                'siswa.jurusan',
                'siswa.rombel',
                DB::raw('CONCAT(siswa.kelas, " ", siswa.jurusan, " ", siswa.rombel) as kelas_lengkap'),
                DB::raw('COUNT(DISTINCT DATE(jurnal.tgl)) as poin')
            )
            ->groupBy('siswa.id_siswa', 'siswa.nama', 'siswa.kelas', 'siswa.jurusan', 'siswa.rombel')
            ->orderBy('poin', 'DESC')
            ->limit($limit)
            ->get()
            ->map(function ($item, $index) use ($currentSiswaId) {
                return [
                    'rank' => $index + 1,
                    'id_siswa' => $item->id_siswa,
                    'nama' => $item->nama,
                    'kelas' => $item->kelas_lengkap,
                    'jurusan' => $item->jurusan,
                    'poin' => $item->poin,
                    'is_me' => $item->id_siswa == $currentSiswaId,
                ];
            })
            ->toArray();

        return $leaderboard;
    }

    public function getLeaderboardInstansi(int $idInstansi, int $limit = 20, ?int $currentSiswaId = null): array
    {
        $leaderboard = DB::table('jurnal')
            ->join('siswa', 'jurnal.id_siswa', '=', 'siswa.id_siswa')
            ->where('siswa.id_instansi', $idInstansi)
            ->whereIn('jurnal.status_verifikasi', ['verified', 'pending'])
            ->where('jurnal.status_kehadiran', '!=', 'alfa')
            ->select(
                'siswa.id_siswa',
                'siswa.nama',
                'siswa.kelas',
                'siswa.jurusan',
                'siswa.rombel',
                DB::raw('CONCAT(siswa.kelas, " ", siswa.jurusan, " ", siswa.rombel) as kelas_lengkap'),
                DB::raw('COUNT(DISTINCT DATE(jurnal.tgl)) as poin')
            )
            ->groupBy('siswa.id_siswa', 'siswa.nama', 'siswa.kelas', 'siswa.jurusan', 'siswa.rombel')
            ->orderBy('poin', 'DESC')
            ->limit($limit)
            ->get()
            ->map(function ($item, $index) use ($currentSiswaId) {
                return [
                    'rank' => $index + 1,
                    'id_siswa' => $item->id_siswa,
                    'nama' => $item->nama,
                    'kelas' => $item->kelas_lengkap,
                    'poin' => $item->poin,
                    'is_me' => $item->id_siswa == $currentSiswaId,
                ];
            })
            ->toArray();

        return $leaderboard;
    }

    public function getPersonalRank(int $siswaId, string $type, $filterValue): int
    {
        $query = DB::table('jurnal')
            ->join('siswa', 'jurnal.id_siswa', '=', 'siswa.id_siswa')
            ->whereIn('jurnal.status_verifikasi', ['verified', 'pending'])
            ->where('jurnal.status_kehadiran', '!=', 'alfa')
            ->select(
                'siswa.id_siswa',
                DB::raw('COUNT(DISTINCT DATE(jurnal.tgl)) as poin')
            );

        if ($type === 'kelas') {
            $kelas = $filterValue['kelas'];
            $jurusan = $filterValue['jurusan'];
            $rombel = $filterValue['rombel'];
            
            $query->where('siswa.kelas', $kelas)
                  ->where('siswa.jurusan', $jurusan)
                  ->where('siswa.rombel', $rombel);
        } elseif ($type === 'jurusan') {
            $query->where('siswa.jurusan', $filterValue);
        } elseif ($type === 'instansi') {
            $query->where('siswa.id_instansi', $filterValue);
        }

        $rankings = $query->groupBy('siswa.id_siswa')
            ->orderBy('poin', 'DESC')
            ->get()
            ->pluck('id_siswa')
            ->toArray();

        $rank = array_search($siswaId, $rankings);

        return $rank !== false ? $rank + 1 : 999;
    }

    public function clearCache(int $siswaId): void
    {
        $cacheKey = "streak_siswa_{$siswaId}";
        Cache::forget($cacheKey);
    }
}