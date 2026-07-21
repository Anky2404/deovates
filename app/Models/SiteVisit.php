<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'session_id',
        'ip_address',
        'path',
        'referrer',
        'user_agent',
        'browser',
        'platform',
        'device_type',
    ];
}
