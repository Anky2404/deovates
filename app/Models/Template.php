<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasSlug, HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'type',
        'description',
        'layouts',
        'settings',
        'meta_title',
        'meta_description',
        'is_active',
        'is_default',
        'usage_count',
    ];

    protected function casts(): array
    {
        return [
            'layouts' => 'array',
            'settings' => 'array',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'usage_count' => 'integer',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('display_order');
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Form::class, 'template_forms')
            ->withPivot('is_active', 'display_order', 'position', 'section_slug')
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }
}
