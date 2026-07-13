<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'title',
        'description',
        'template_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'is_active',
        'is_homepage',
        'display_order',
        'published_at',
        'created_by',
        'updated_by',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'meta_keywords' => 'array',
            'is_active' => 'boolean',
            'is_homepage' => 'boolean',
            'display_order' => 'integer',
            'published_at' => 'datetime',
            'views' => 'integer',
        ];
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class, 'page_sections', 'page_id', 'form_id')
            ->withPivot('is_active')
            ->withTimestamps()
            ->with('fields');
    }

    public function content(): HasOne
{
    return $this->hasOne(PageContent::class);
}

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('published_at')
                ->orWhere('published_at', '<=', now()));
    }

    public function scopeHomepage(Builder $query): Builder
    {
        return $query->where('is_homepage', true);
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
