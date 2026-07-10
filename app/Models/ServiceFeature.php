<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceFeature extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'service_id',
        'title',
        'short_description',
        'icon',
        'image',
        'is_highlighted',
        'is_active',
        'display_order',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'is_highlighted' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeHighlighted(Builder $query): Builder
    {
        return $query->where('is_highlighted', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }
}
