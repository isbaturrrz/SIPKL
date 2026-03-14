<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('fonnte.token');
        $this->url = config('fonnte.url');
    }

    /**
     * @param string 
     * @param string 
     * @return array
     */
    public function sendMessage($phone, $message)
{
    try {
        if (empty($this->token)) {
            throw new \Exception('FONNTE_TOKEN belum diset di .env');
        }
        if (empty($this->url)) {
            throw new \Exception('FONNTE_URL belum diset di .env');
        }

        $phone = $this->formatPhoneNumber($phone);

        $response = Http::timeout(10)
            ->withoutVerifying()
            ->withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target'      => $phone,
                'message'     => $message,
                'countryCode' => '62',
            ]);

        $rawBody  = $response->body();
        $jsonData = json_decode($rawBody, true);

        Log::info('WhatsApp sent', [
            'phone'       => $phone,
            'http_status' => $response->status(),
            'raw_body'    => $rawBody,
        ]);

        $httpOk    = $response->status() >= 200 && $response->status() < 300;
        $fonnte_ok = isset($jsonData['status']) ? (bool) $jsonData['status'] : $httpOk;

        return [
            'success' => $httpOk && $fonnte_ok,
            'data'    => $jsonData ?? ['raw' => $rawBody],
        ];

    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        Log::error('WhatsApp connection error: ' . $e->getMessage());
        return ['success' => false, 'error' => 'Koneksi gagal: ' . $e->getMessage()];

    } catch (\Exception $e) {
        Log::error('WhatsApp error: ' . $e->getMessage());
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    public function sendReminderBelumIsi($siswa)
    {
        $message = "🔔 *Reminder PKL*\n\n";
        $message .= "Halo *{$siswa->nama}*,\n\n";
        $message .= "Kamu belum mengisi jurnal PKL untuk hari ini.\n";
        $message .= "Jangan lupa isi sebelum jam 23:59 ya! 📝\n\n";
        $message .= "Login di: " . url('/') . "\n\n";
        $message .= "_Pesan otomatis dari SIPKL_";

        return $this->sendMessage($siswa->no_hp, $message);
    }

    public function sendKonfirmasiSudahIsi($siswa, $tanggal)
    {
        $message = "✅ *Jurnal Tercatat*\n\n";
        $message .= "Terima kasih *{$siswa->nama}*!\n\n";
        $message .= "Jurnal PKL kamu untuk tanggal *{$tanggal}* sudah berhasil tercatat.\n";
        $message .= "Tetap semangat! 💪\n\n";
        $message .= "_Pesan otomatis dari SIPKL_";

        return $this->sendMessage($siswa->no_hp, $message);
    }

    public function sendNotifikasiDitolak($siswa, $tanggal, $alasan)
    {
        $message = "❌ *Jurnal Ditolak*\n\n";
        $message .= "Halo *{$siswa->nama}*,\n\n";
        $message .= "Jurnal PKL kamu untuk tanggal *{$tanggal}* ditolak.\n\n";
        $message .= "*Alasan:*\n{$alasan}\n\n";
        $message .= "Silakan perbaiki dan kirim ulang.\n\n";
        $message .= "Login di: " . url('/') . "\n\n";
        $message .= "_Pesan otomatis dari SIPKL_";

        return $this->sendMessage($siswa->no_hp, $message);
    }

    public function sendNotifikasiDiverifikasi($siswa, $tanggal)
    {
        $message = "✅ *Jurnal Diverifikasi*\n\n";
        $message .= "Halo *{$siswa->nama}*,\n\n";
        $message .= "Jurnal PKL kamu untuk tanggal *{$tanggal}* telah diverifikasi oleh pembimbing.\n\n";
        $message .= "Selamat! Lanjutkan semangat PKL nya! 🎉\n\n";
        $message .= "_Pesan otomatis dari SIPKL_";

        return $this->sendMessage($siswa->no_hp, $message);
    }
}