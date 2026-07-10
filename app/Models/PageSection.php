<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageSection extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'page_id',
        'form_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
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

    /* =========================
     | SCOPES
     ========================= */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByPage(Builder $query, $pageId): Builder
    {
        return $query->where('page_id', $pageId);
    }
}
