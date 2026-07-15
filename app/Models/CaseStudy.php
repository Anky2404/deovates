<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseStudy extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected string $slugSource = 'title';

    protected $table = 'case_studies';

    protected $fillable = [
        'uuid',
        'case_study_category_id',
        'title',
        'slug',
        'client_name',
        'industry',
        'project_duration',
        'project_budget',
        'featured_image',
        'featured_image_alt',
        'banner_image',
        'banner_image_alt',
        'video_url',
        'overview',
        'challenges',
        'solutions',
        'results',
        'testimonial',
        'key_metrics',
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
            'key_metrics' => 'array',
            'meta_keywords' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Gallery images, backed by the polymorphic Media table (collection
     * "gallery") rather than a flat JSON column.
     */
    public function galleryMedia(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection', 'gallery')
            ->orderBy('display_order');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CaseStudyCategory::class, 'case_study_category_id');
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
