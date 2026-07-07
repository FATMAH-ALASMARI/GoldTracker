<?php

namespace App\Exports;

use App\Models\GoldPrice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GoldPricesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return GoldPrice::select(
            'id',
            'karat',
            'price',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'الرقم',
            'العيار',
            'السعر',
            'تاريخ الإضافة',
        ];
    }
}