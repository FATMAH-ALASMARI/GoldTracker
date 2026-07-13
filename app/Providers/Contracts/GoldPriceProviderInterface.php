<?php

namespace App\Providers\Contracts;

interface GoldPriceProviderInterface
{
    /**
     * جلب أسعار الذهب من المصدر.
     *
     * @return array
     */
    public function getPrices(): array;
}
