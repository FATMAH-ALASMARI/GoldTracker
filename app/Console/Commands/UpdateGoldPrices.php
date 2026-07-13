<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GoldPriceService;

class UpdateGoldPrices extends Command
{
    /**
     * اسم الأمر
     */
    protected $signature = 'gold:update';

    /**
     * وصف الأمر
     */
    protected $description = 'Fetch latest gold prices from GoldAPI';

    public function handle(GoldPriceService $service): int
    {
        $this->info('جاري الاتصال بـ GoldAPI ...');

        try {

            $service->updatePrices();

            $this->info('✅ تم تحديث الأسعار بنجاح.');

            return self::SUCCESS;

        } catch (\Throwable $e) {

            $this->error('❌ فشل التحديث');

            $this->error($e->getMessage());

            return self::FAILURE;

        }
    }
}
