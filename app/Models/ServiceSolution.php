<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceSolution extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'service_problem_id',
        'service_id',
        'title',
        'description',
        'icon',
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

    // The service this solution belongs to
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // The problem this solution addresses
    public function problem(): BelongsTo
    {
        return $this->belongsTo(ServiceProblem::class, 'service_problem_id');
    }

    // Only active solutions
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
