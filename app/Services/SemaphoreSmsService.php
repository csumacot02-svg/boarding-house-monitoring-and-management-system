<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SemaphoreSmsService
{
    public function send(string $number, string $message): bool
    {
        $response = Http::asForm()->post('https://api.semaphore.co/api/v4/messages', [
            'apikey' => config('services.semaphore.key'),
            'number' => $number,
            'message' => $message,
            'sendername' => config('services.semaphore.sender_name'),
        ]);

        if (! $response->successful()) {
            Log::error('Semaphore SMS failed', [
                'number' => $number,
                'response' => $response->body(),
            ]);

            return false;
        }

        return true;
    }
}