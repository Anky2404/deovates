<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceProblem extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'service_id',
        'title',
        'description',
        'image',
        'is_active',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    // The service this problem belongs to
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Solutions that address this problem, in display order
    public function solutions(): HasMany
    {
        return $this->hasMany(ServiceSolution::class)->orderBy('display_order');
    }

    // Only active problems
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Sorted by display order
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }
}
