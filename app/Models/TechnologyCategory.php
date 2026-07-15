<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechnologyCategory extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'icon',
        'image',
        'image_alt',
        'description',
        'meta_title',
        'meta_description',
        'is_active',
        'is_featured',
        'display_order',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
        ];
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(Technology::class)->orderBy('display_order');
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
}
