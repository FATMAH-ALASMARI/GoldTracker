<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldPriceHistory extends Model
{
    protected $fillable = [

        'batch_id',

        'karat',

        'price',

        'currency',

        'source',

        'fetched_at',

        'response_time_ms',

    ];

    protected $casts = [

        'fetched_at' => 'datetime',

    ];
}
