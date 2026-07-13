<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialLink extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected string $slugSource = 'platform';

    protected $fillable = [
        'uuid',
        'platform',
        'slug',
        'icon',
        'url',
        'linkable_type',
        'linkable_id',
        'username',
        'is_verified',
        'is_active',
        'is_featured',
        'display_order',
        'clicks',
    ];

    protected function casts(): array
    {
        return [
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
            'clicks' => 'integer',
        ];
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }
}
