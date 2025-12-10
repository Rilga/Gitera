<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Import Log Facade

trait WhatsappTrait
{
    protected $fonnteBaseUrl = 'https://api.fonnte.com/send';

    /**
     * Mengirim pesan WhatsApp menggunakan API Fonnte.
     *
     * @param string $target Nomor telepon tujuan (misal: 628123456789)
     * @param string $message Isi pesan yang akan dikirim
     * @return bool
     */
    protected function sendWhatsappNotification(string $target, string $message): bool
    {
        // 1. Ambil token di dalam fungsi untuk menghindari masalah Trait constructor
        $fonnteApiToken = env('FONNTE_API_TOKEN'); 

        // 2. Validasi Token dan Target
        if (!$fonnteApiToken) {
            Log::error('Gagal mengirim WhatsApp: FONNTE_API_TOKEN tidak ditemukan di .env.');
            return false;
        }

        if (!$target) {
            Log::error('Gagal mengirim WhatsApp: Nomor telepon target kosong.');
            return false;
        }

        // 3. Format Nomor (Mengubah 08... menjadi 628...)
        $target = preg_replace('/^08/', '628', $target); 
        $target = preg_replace('/^\+62/', '62', $target);

        // 4. Kirim Request ke Fonnte API
        try {
            $response = Http::withHeaders([
                'Authorization' => $fonnteApiToken, // Gunakan token yang diambil
            ])->post($this->fonnteBaseUrl, [
                'target' => $target,
                'message' => $message,
            ]);

            $responseData = $response->json();

            // 5. Cek Respons
            if ($response->successful() && isset($responseData['status']) && $responseData['status'] == 'success') {
                Log::info('WhatsApp terkirim sukses.', ['target' => $target, 'response' => $responseData]);
                return true;
            }

            // Jika respons gagal
            Log::error('Gagal mengirim WhatsApp via Fonnte:', [
                'target' => $target,
                'response_status' => $response->status(),
                'response_body' => $responseData
            ]);

            return false;
            
        } catch (\Exception $e) {
            Log::error('Kesalahan koneksi saat mengirim WhatsApp:', [
                'target' => $target,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}