<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteAuditLead extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'type',
        'name',
        'email',
        'phone',
        'url',
        'mobile_scores',
        'mobile_metrics',
        'desktop_scores',
        'desktop_metrics',
        'seo_audit',
        'status',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'mobile_scores' => 'array',
            'mobile_metrics' => 'array',
            'desktop_scores' => 'array',
            'desktop_metrics' => 'array',
            'seo_audit' => 'array',
        ];
    }

    public function scopeSpeed(Builder $query): Builder
    {
        return $query->where('type', 'speed');
    }

    public function scopeSeo(Builder $query): Builder
    {
        return $query->where('type', 'seo');
    }
}
