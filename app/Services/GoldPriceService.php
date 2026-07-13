<?php

namespace App\Services;

use App\Models\GoldPrice;
use App\Models\GoldPriceHistory;
use App\Providers\Contracts\GoldPriceProviderInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GoldPriceService
{
    public function __construct(
        protected GoldPriceProviderInterface $provider
    ) {}

    public function updatePrices(bool $force = false): bool
    {
        $latestHistory = GoldPriceHistory::latest('fetched_at')->first();

        if (
            !$force &&
            $latestHistory &&
            $latestHistory->fetched_at &&
            $latestHistory->fetched_at->gt(now()->subMinutes(5))
        ) {
            return false;
        }

        DB::transaction(function () {

            $prices = $this->provider->getPrices();

            $batchId = (string) Str::uuid();

            $fetchedAt = now();

            foreach ($prices as $price) {

                GoldPrice::updateOrCreate(
                    [
                        'karat' => $price->karat,
                    ],
                    [
                        'price' => $price->price,
                    ]
                );

                GoldPriceHistory::create([
                    'batch_id' => $batchId,
                    'karat' => $price->karat,
                    'price' => $price->price,
                    'currency' => $price->currency,
                    'source' => $price->source,
                    'fetched_at' => $fetchedAt,
                    'response_time_ms' => $price->responseTimeMs,
                ]);
            }
        });

        return true;
    }
}