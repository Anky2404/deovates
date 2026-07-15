<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected string $slugSource = 'title';

    protected $fillable = [
        'uuid',
        'parent_service_id',
        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'featured_image',
        'featured_image_alt',
        'banner_image',
        'banner_image_alt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'rating',
        'review_count',
        'is_featured',
        'is_active',
        'display_order',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'meta_keywords' => 'array',
            'rating' => 'integer',
            'review_count' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
        ];
    }

    public function faqs(): HasMany
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('display_order');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ServiceFeature::class)->orderBy('display_order');
    }

    public function servicePlatforms(): HasMany
    {
        return $this->hasMany(ServicePlatform::class)->orderBy('display_order');
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'service_platforms')
            ->withPivot('is_active', 'is_featured', 'display_order', 'views')
            ->withTimestamps();
    }

    public function challenges(): HasMany
    {
        return $this->hasMany(ServiceChallenge::class)->orderBy('display_order');
    }

    public function serviceTechnologies(): HasMany
    {
        return $this->hasMany(ServiceTechnology::class)->orderBy('display_order');
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'service_technology')
            ->withPivot('is_active', 'is_featured', 'display_order')
            ->withTimestamps();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewable_id')
            ->where('reviewable_type', self::class);
    }

    public function parentService(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_service_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_service_id')
            ->where('is_active', true)
            ->orderBy('display_order');
    }

    public function problems(): HasMany
    {
        return $this->hasMany(ServiceProblem::class)->active()->ordered();
    }

    public function solutions(): HasMany
    {
        return $this->hasMany(ServiceSolution::class)->active()->ordered();
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

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
