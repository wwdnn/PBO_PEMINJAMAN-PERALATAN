<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Models\Activity as ActivityLogModel;

class ActivityLog extends ActivityLogModel
{
    use HasFactory;

    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'description',
        'subject_id',
        'subject_type',
        'subject_name',
        'causer_id',
        'causer_type',
        'causer_name',
        'properties',
        'created_at',
        'updated_at',
    ];
}
