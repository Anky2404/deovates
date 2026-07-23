<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasUuid, SoftDeletes;

    protected $table = 'media';

    protected $fillable = [
        'uuid',
        'model_type',
        'model_id',
        'collection',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'path',
        'size',
        'width',
        'height',
        'duration',
        'alt_text',
        'caption',
        'is_featured',
        'is_private',
        'is_active',
        'display_order',
        'custom_properties',
        'conversions',
        'meta',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'custom_properties' => 'array',
            'conversions' => 'array',
            'meta' => 'array',
            'size' => 'integer',
            'width' => 'integer',
            'height' => 'integer',
            'duration' => 'integer',
            'is_featured' => 'boolean',
            'is_private' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function relations(): HasMany
    {
        return $this->hasMany(MediaRelation::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_private', false);
    }

    public function scopeByCollection(Builder $query, string $collection): Builder
    {
        return $query->where('collection', $collection);
    }

    public function scopeImages(Builder $query): Builder
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    public function scopeVideos(Builder $query): Builder
    {
        return $query->where('mime_type', 'like', 'video/%');
    }

    public function getUrlAttribute(): string
    {
        return asset("storage/{$this->path}");
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }
}
