<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionContent extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'page_name',
        'section_name',
        'section_label',
        'section_title',
        'section_subtitle',
        'left_description',
        'right_list',
        'display_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function scopeForPage(Builder $query, string $pageName): Builder
    {
        return $query->where('page_name', $pageName);
    }

    public function scopeForSection(Builder $query, string $pageName, string $sectionName): Builder
    {
        return $query->where('page_name', $pageName)->where('section_name', $sectionName);
    }
}
