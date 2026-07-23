<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Session extends Model
{
    protected $table = 'sessions';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    protected function casts(): array
    {
        return [
            'last_activity' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive(Builder $query, ?int $minutes = null): Builder
    {
        $lifetime = $minutes ?? config('session.lifetime');

        return $query->where('last_activity', '>=', now()->subMinutes($lifetime)->timestamp);
    }

    public function scopeExpired(Builder $query, ?int $minutes = null): Builder
    {
        $lifetime = $minutes ?? config('session.lifetime');

        return $query->where('last_activity', '<', now()->subMinutes($lifetime)->timestamp);
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function getLastActivityAtAttribute(): ?Carbon
    {
        return $this->last_activity
            ? Carbon::createFromTimestamp($this->last_activity)
            : null;
    }

    public function isExpired(?int $minutes = null): bool
    {
        $lifetime = $minutes ?? config('session.lifetime');

        return $this->last_activity < now()->subMinutes($lifetime)->timestamp;
    }

    public function destroySession(): bool
    {
        return $this->delete();
    }
}
