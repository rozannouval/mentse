<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log($activity, $description = null)
    {
        if (!auth()->check()) return;

        ActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => $activity,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
