<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{
    public function send(array $tokens, string $title, string $body, array $data = [])
    {
        $serverKey = config('services.firebase.server_key');

        return Http::withHeaders([
            'Authorization' => 'key=' . $serverKey,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data
        ]);
    }
}
