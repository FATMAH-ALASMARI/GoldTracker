<?php

namespace App\Helpers;

use App\Models\ActivityLog;

class ActivityHelper
{
    public static function log($action, $description)
    {
        if (auth()->check()) {

            ActivityLog::create([

                'user_id' => auth()->id(),

                'action' => $action,

                'description' => $description,

            ]);

        }
    }
}
