<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPermission extends Model
{
    use App\Traits\HasUuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'permission_id',
        'is_allowed',
        'expires_at',
        'conditions',
        'meta',
        'granted_by',
    ];

    protected function casts(): array
    {
        return [
            'conditions' => 'array',
            'meta' => 'array',
            'is_allowed' => 'boolean',
            'expires_at' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    public function grantedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'granted_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_allowed', true)
            ->where(fn($q) => $q->whereNull('expires_at')
                ->orWhere('expires_at', '>=', now()));
    }

    public function scopeExpired(Builder $query): Builder
    {
        return $query->whereNotNull('expires_at')
            ->where('expires_at', '<', now());
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at < now();
    }
}
