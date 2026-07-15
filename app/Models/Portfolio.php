<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected string $slugSource = 'title';

    protected $fillable = [
        'uuid',
        'portfolio_category_id',
        'title',
        'slug',
        'client_name',
        'project_url',
        'project_duration',
        'project_budget',
        'featured_image',
        'featured_image_alt',
        'banner_image',
        'banner_image_alt',
        'gallery',
        'video_url',
        'overview',
        'description',
        'challenges',
        'solutions',
        'results',
        'project_type',
        'industry',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'is_featured',
        'is_active',
        'display_order',
        'views',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'meta_keywords' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Each gallery item is ["path" => ..., "alt" => ...]. Old records were
     * saved as a flat array of path strings before alt text existed —
     * normalize those into the same shape on read so every consumer
     * (views, controllers) only ever sees one format.
     */
    protected function gallery(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                $items = is_string($value) ? (json_decode($value, true) ?: []) : (array) ($value ?? []);

                return array_map(
                    fn ($item) => is_array($item) ? $item : ['path' => $item, 'alt' => null],
                    $items
                );
            },
            set: fn ($value) => json_encode($value ?? []),
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('display_order');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'portfolio_skills')
            ->withPivot('is_active', 'is_featured', 'display_order')
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('published_at')
                ->orWhere('published_at', '<=', now()));
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
