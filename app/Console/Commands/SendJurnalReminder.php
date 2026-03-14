<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;
use App\Models\Jurnal;
use App\Services\WhatsAppService;
use Carbon\Carbon;

class SendJurnalReminder extends Command
{
    protected $signature = 'jurnal:reminder';
    protected $description = 'Kirim reminder WA ke siswa yang belum isi jurnal';

    public function handle()
    {
        $this->info('🔍 Memulai pengecekan jurnal...');

        $today = Carbon::today();
        $whatsapp = new WhatsAppService();

        $siswaList = Siswa::whereHas('instansi')
            ->with('user')
            ->get();

        $belumIsi = 0;
        $sudahIsi = 0;
        $gagalKirim = 0;

        foreach ($siswaList as $siswa) {
            $jurnal = Jurnal::where('id_siswa', $siswa->id_siswa)
                ->whereDate('tgl', $today)
                ->first();

            if (!$jurnal) {
                $this->info("📤 Kirim reminder ke: {$siswa->nama}");
                
                $result = $whatsapp->sendReminderBelumIsi($siswa);
                
                if ($result['success']) {
                    $belumIsi++;
                    $this->info("   ✅ Berhasil");
                } else {
                    $gagalKirim++;
                    $this->error("   ❌ Gagal: " . ($result['error'] ?? 'Unknown'));
                }

            } else {
                $sudahIsi++;
                $this->info("✅ {$siswa->nama} sudah isi jurnal");
            }
        }

        $this->info("\n📊 RINGKASAN:");
        $this->info("   - Sudah isi jurnal: {$sudahIsi}");
        $this->info("   - Reminder dikirim: {$belumIsi}");
        $this->info("   - Gagal kirim: {$gagalKirim}");
        $this->info("\n✅ Selesai!");

        return 0;
    }
}