<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoldPrice;
use App\Models\GoldPriceHistory;
use App\Models\ActivityLog;
use App\Services\GoldPriceService;
use Illuminate\Http\RedirectResponse;

class SystemHealthController extends Controller
{
    public function index()
    {
        $totalPrices = GoldPrice::count();

        $historyCount = GoldPriceHistory::count();

        $lastUpdate = GoldPriceHistory::latest('fetched_at')->first();

        $lastActivity = ActivityLog::latest()->first();

        return view('admin.system-health', compact(
            'totalPrices',
            'historyCount',
            'lastUpdate',
            'lastActivity'
        ));
    }

    public function updateNow(
        GoldPriceService $service
    ): RedirectResponse {

        try {

            $service->updatePrices(true);

            return redirect()
                ->route('admin.system-health')
                ->with(
                    'success',
                    'تم تحديث الأسعار بنجاح.'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.system-health')
                ->with(
                    'error',
                    'فشل تحديث الأسعار. يرجى المحاولة مرة أخرى.'
                );
        }
    }
}