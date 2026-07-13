<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioSkill extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'portfolio_id',
        'skill_id',
        'is_active',
        'is_featured',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    // The portfolio this pivot row belongs to
    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    // The linked skill
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    // Only active rows
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Sorted by display order
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    // Only featured rows
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}
