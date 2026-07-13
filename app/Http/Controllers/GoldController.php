<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldPrice;
use App\Models\GoldPriceHistory;
use App\Models\ActivityLog;
use App\Exports\GoldPricesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class GoldController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Gold Prices Query
        |--------------------------------------------------------------------------
        */

        $query = GoldPrice::query();

        if ($request->filled('search')) {
            $query->where(
                'karat',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('from_date')) {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date')) {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to_date
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = [
            'price',
            'created_at',
            'karat'
        ];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $query->orderBy($sort, $direction);

        $prices = $query
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalPrices = GoldPrice::count();

        $highestPrice = GoldPrice::max('price');

        $lowestPrice = GoldPrice::min('price');

        $averagePrice = round(
            GoldPrice::avg('price'),
            2
        );


        /*
        |--------------------------------------------------------------------------
        | Historical Chart Data
        |--------------------------------------------------------------------------
        */

        $karats = ['24', '22', '21', '18'];

        $historyQuery = GoldPriceHistory::query()
            ->whereIn('karat', $karats);

        if ($request->filled('from_date')) {
            $historyQuery->whereDate(
                'fetched_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date')) {
            $historyQuery->whereDate(
                'fetched_at',
                '<=',
                $request->to_date
            );
        }

        $history = $historyQuery
            ->latest('fetched_at')
            ->take(80)
            ->get()
            ->sortBy('fetched_at')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Unified Chart Labels
        |--------------------------------------------------------------------------
        */

        $chartLabels = $history
            ->map(function ($price) {
                return $price->fetched_at->format('d/m H:i');
            })
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Chart Prices By Karat
        |--------------------------------------------------------------------------
        */

        $chartData = [];

        foreach ($karats as $karat) {

            $karatHistory = $history
                ->where('karat', $karat)
                ->values();

            $pricesByTime = $karatHistory
                ->keyBy(function ($price) {
                    return $price->fetched_at->format('d/m H:i');
                });

            $chartData[$karat] = $chartLabels
                ->map(function ($label) use ($pricesByTime) {

                    return optional(
                        $pricesByTime->get($label)
                    )->price;

                })
                ->values();
        }
/*
|--------------------------------------------------------------------------
| Last Gold Update
|--------------------------------------------------------------------------
*/

$lastUpdate = GoldPriceHistory::query()
    ->latest('fetched_at')
    ->value('fetched_at');

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('home', compact(
            'prices',
            'totalPrices',
            'highestPrice',
            'lowestPrice',
            'averagePrice',
            'chartLabels',
            'chartData',
            'lastUpdate'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('create');
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'karat' => 'required|max:10',
            'price' => 'required|numeric|min:1',
        ]);

        GoldPrice::create([
            'karat' => $request->karat,
            'price' => $request->price,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'إضافة سعر ذهب جديد',
            'karat' => $request->karat,
            'price' => $request->price,
        ]);

        return redirect('/')
            ->with('success', 'تمت إضافة السعر بنجاح');
    }


    /*
    |--------------------------------------------------------------------------
    | Export
    |--------------------------------------------------------------------------
    */

    public function export()
    {
        return Excel::download(
            new GoldPricesExport(),
            'gold_prices.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $price = GoldPrice::findOrFail($id);

        return view('edit', compact('price'));
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'karat' => 'required|max:10',
            'price' => 'required|numeric|min:1',
        ]);

        $price = GoldPrice::findOrFail($id);

        $price->update([
            'karat' => $request->karat,
            'price' => $request->price,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'تعديل سعر الذهب',
            'karat' => $request->karat,
            'price' => $request->price,
        ]);

        return redirect('/')
            ->with('success', 'تم تحديث السعر بنجاح');
    }


    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $goldPrice = GoldPrice::findOrFail($id);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'حذف سعر الذهب',
            'karat' => $goldPrice->karat,
            'price' => $goldPrice->price,
        ]);

        $goldPrice->delete();

        return redirect('/')
            ->with('success', 'تم حذف السعر بنجاح');
    }
}