<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'icon',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id');
    }

    public function publishedBlogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'category_id')
            ->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getBlogCountAttribute(): int
    {
        return $this->publishedBlogs()->count();
    }
}
