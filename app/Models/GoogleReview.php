<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoogleReview extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'google_review_id',
        'author_name',
        'author_photo_url',
        'author_url',
        'rating',
        'review_text',
        'relative_time_description',
        'language',
        'review_time',
        'is_active',
        'fetched_at',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_active' => 'boolean',
            'review_time' => 'datetime',
            'fetched_at' => 'datetime',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
