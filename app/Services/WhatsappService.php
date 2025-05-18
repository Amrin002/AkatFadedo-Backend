<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey
        ])
            ->post('https://api.fonnte.com/v1/messages', [
                'to' => $to,
                'from' => $this->phoneNumber,
                'body' => $message,
            ]);

        return $response->json();
    }
}
