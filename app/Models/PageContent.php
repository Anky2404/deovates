<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'page_id',
        'form_id',
        'content',
        'settings',
        'display_order',
        'position',
        'column',
        'is_active',
        'is_visible',
        'is_global',
        'device',
        'views',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'settings' => 'array',
            'display_order' => 'integer',
            'is_active' => 'boolean',
            'is_visible' => 'boolean',
            'is_global' => 'boolean',
            'views' => 'integer',
        ];
    }

    /* =========================
     | RELATIONS
     ========================= */

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /* =========================
     | SCOPES
     ========================= */

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

    public function scopeByPage(Builder $query, $pageId): Builder
    {
        return $query->where('page_id', $pageId);
    }

    public function scopeByPosition(Builder $query, string $position): Builder
    {
        return $query->where('position', $position);
    }

    public function scopeByDevice(Builder $query, string $device): Builder
    {
        return $query->where(function ($q) use ($device) {
            $q->whereNull('device')
              ->orWhere('device', $device);
        });
    }

    public function scopeGlobal(Builder $query): Builder
    {
        return $query->where('is_global', true);
    }

    /* =========================
     | HELPERS
     ========================= */

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
