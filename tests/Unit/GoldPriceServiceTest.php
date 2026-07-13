<?php

use App\Data\GoldPriceData;
use App\Models\GoldPriceHistory;
use App\Providers\Contracts\GoldPriceProviderInterface;
use App\Services\GoldPriceService;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

it('skips duplicate updates when a recent update already exists', function () {
    $provider = new class implements GoldPriceProviderInterface {
        public int $callCount = 0;

        public function getPrices(): array
        {
            $this->callCount++;

            return [
                new GoldPriceData(
                    karat: '24',
                    price: 100,
                    currency: 'SAR',
                    source: 'GoldAPI',
                    fetchedAt: now(),
                ),
            ];
        }
    };

    $service = new GoldPriceService($provider);

    $service->updatePrices();
    $service->updatePrices();

    expect(GoldPriceHistory::count())->toBe(1);
    expect($provider->callCount)->toBe(1);
});
