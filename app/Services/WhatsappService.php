<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $apiKey;
    protected $phoneNumber;

    public function __construct()
    {
        $this->apiKey = env('FONNTE_API_KEY'); // Ambil API key dari .env
        $this->phoneNumber = env('FONNTE_PHONE_NUMBER'); // Ambil nomor WhatsApp dari .env
    }

    // Fungsi untuk mengirim pesan WhatsApp
    public function sendMessage($to, $message)
    {
        // Mengirim pesan ke API Fonnte
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])
            ->post('https://api.fonnte.com/v1/messages', [
                'to' => $to,
                'from' => $this->phoneNumber,
                'body' => $message,
            ]);

        // Mengecek jika response statusnya sukses
        if ($response->successful()) {
            return $response->json();  // Mengembalikan response JSON dari API
        } else {
            // Jika ada error, log status code dan pesan errornya
            Log::error('WhatsApp API Error:', [
                'status' => $response->status(),
                'error' => $response->body()
            ]);
            return null;  // Mengembalikan null jika API gagal
        }
    }
}
