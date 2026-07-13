<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(
        \Illuminate\Foundation\Inspiring::quote()
    );
})->purpose('Display an inspiring quote');


/*
|--------------------------------------------------------------------------
| Gold Price Scheduler
|--------------------------------------------------------------------------
| تحديث أسعار الذهب تلقائيًا كل 5 دقائق
*/

Schedule::command('gold:update')
    ->everyFiveMinutes()
    ->withoutOverlapping();