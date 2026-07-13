<?php

namespace App\Providers;

use App\Clients\GoldApiClient;
use App\Data\GoldPriceData;
use App\Providers\Contracts\GoldPriceProviderInterface;

class GoldApiProvider implements GoldPriceProviderInterface
{
    public function __construct(
        protected GoldApiClient $client
    ) {}

    public function getPrices(): array
    {
        $data = $this->client->fetch();

        $now = new \DateTime();

        return [

            new GoldPriceData(
                karat: '24',
                price: $data['price_gram_24k'],
                currency: $data['currency'],
                source: 'GoldAPI',
                fetchedAt: $now
            ),

            new GoldPriceData(
                karat: '22',
                price: $data['price_gram_22k'],
                currency: $data['currency'],
                source: 'GoldAPI',
                fetchedAt: $now
            ),

            new GoldPriceData(
                karat: '21',
                price: $data['price_gram_21k'],
                currency: $data['currency'],
                source: 'GoldAPI',
                fetchedAt: $now
            ),

            new GoldPriceData(
                karat: '18',
                price: $data['price_gram_18k'],
                currency: $data['currency'],
                source: 'GoldAPI',
                fetchedAt: $now
            ),

        ];
    }
}
