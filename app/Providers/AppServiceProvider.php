<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Providers\Contracts\GoldPriceProviderInterface;
use App\Providers\GoldApiProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            GoldPriceProviderInterface::class,
            GoldApiProvider::class
        );
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}