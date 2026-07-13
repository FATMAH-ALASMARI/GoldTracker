<?php

namespace App\Data;

class GoldPriceData
{
    public function __construct(

        public string $karat,

        public float $price,

        public string $currency,

        public string $source,

        public \DateTime $fetchedAt,

        public ?int $responseTimeMs = null,

    ) {}
}
