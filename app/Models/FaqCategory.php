<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    use HasUuid, SoftDeletes;

    public $table='faq_categories';

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'page',
        'short_description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relationships
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('display_order');
    }

    public function activeFaqs(): HasMany
    {
        return $this->hasMany(Faq::class)
            ->where('is_active', true)
            ->orderBy('display_order');
    }

    /**
     * Scopes
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePage(Builder $query, string $page): Builder
    {
        return $query->where('page', $page);
    }

    /**
     * Helpers
     */
    public function hasFaqs(): bool
    {
        return $this->faqs()->exists();
    }
}
