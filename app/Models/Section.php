<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasUuid, HasSlug, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'form_id',
        'content',
        'settings',
        'type',
        'is_active',
        'is_visible',
        'display_order',
        'views',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'settings' => 'array',
            'is_active' => 'boolean',
            'is_visible' => 'boolean',
            'display_order' => 'integer',
            'views' => 'integer',
        ];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'page_section_links')
            ->withPivot('is_active', 'display_order')
            ->withTimestamps()
            ->orderByPivot('display_order');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
