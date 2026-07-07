<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldPrice;
use App\Exports\GoldPricesExport;
use Maatwebsite\Excel\Facades\Excel;

class GoldController extends Controller
{
    public function index(Request $request)
    {
        $query = GoldPrice::query();

        if ($request->filled('search')) {
            $query->where('karat', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['price', 'created_at', 'karat'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $query->orderBy($sort, $direction);

        $prices = $query->paginate(10)->withQueryString();
        $totalPrices = $prices->total();
        $highestPrice = $prices->getCollection()->max('price');
        $lowestPrice = $prices->getCollection()->min('price');
        $averagePrice = round(
            $prices->getCollection()->avg('price'),
            2
        );
        $labels = $prices->getCollection()->pluck('karat');
        $chartPrices = $prices->getCollection()->pluck('price');

        return view('home', compact(
            'prices',
            'totalPrices',
            'highestPrice',
            'lowestPrice',
            'averagePrice',
            'labels',
            'chartPrices'
        ));
    }


    public function create()
    {
        return view('create');
    }

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

        return redirect('/')->with('success', 'تمت إضافة السعر بنجاح');
    }

    public function export()
    {
        return Excel::download(
            new GoldPricesExport(),
            'gold_prices.xlsx'
        );
    }


    public function edit($id)
    {
        $price = GoldPrice::findOrFail($id);

        return view('edit', compact('price'));
    }
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

        return redirect('/')->with('success', 'تم تحديث السعر بنجاح');
    }
public function destroy($id)
{
    $price = GoldPrice::findOrFail($id);

    $price->delete();

    return redirect('/');
}
}