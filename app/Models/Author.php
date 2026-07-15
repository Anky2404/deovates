<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'slug',
        'email',
        'phone',
        'profile_image',
        'profile_image_alt',
        'cover_image',
        'cover_image_alt',
        'bio',
        'designation',
        'company',
        'website',
        'social_links',
        'meta_title',
        'meta_description',
        'total_blogs',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'total_blogs' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function updateBlogCount(): void
    {
        $this->update(['total_blogs' => $this->blogs()->count()]);
    }
}
