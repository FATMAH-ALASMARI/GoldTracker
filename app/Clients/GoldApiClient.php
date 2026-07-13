<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;

class GoldApiClient
{
    public function fetch(): array
    {
        $response = Http::timeout(10)
            ->retry(2, 1000)
            ->withHeaders([
                'x-access-token' => config('gold.goldapi.api_key'),
                'Content-Type'   => 'application/json',
            ])
            ->get(config('gold.goldapi.base_url') . '/XAU/USD');

        if (! $response->successful()) {
            throw new \Exception(
                'GoldAPI Error: ' . $response->status()
            );
        }

        return $response->json();
    }
}
