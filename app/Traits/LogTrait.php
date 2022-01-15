<?php

namespace App\Traits;

use App\Models\ActivityLogger;
use Illuminate\Support\Facades\Auth;

trait LogTrait
{
    public function createActivityLog($action, $description)
    {
        ActivityLogger::create([
            'name' => request()->user() ? request()->user()->name : null,
            'gender' => request()->user() ? request()->user()->gender : null,
            'email' => request()->user() ? request()->user()->email : null,
            'ipAddress' => request()->ip(),
            'activity' => $action,
            'description' => $description,

        ]);
    }
}
