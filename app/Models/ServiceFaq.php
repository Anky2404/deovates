<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceFaq extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'service_id',
        'question',
        'answer',
        'is_active',
        'is_featured',
        'display_order',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
        ];
    }

    // The service this FAQ belongs to
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Only active FAQs
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Sorted by display order
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    // Only featured FAQs
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}
