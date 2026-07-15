<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'user_role',
        'action',
        'module',
        'subject_type',
        'subject_id',
        'old_values',
        'new_values',
        'description',
        'ip_address',
        'user_agent',
        'url',
        'method',
        'level',
        'meta',
        'is_system',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'meta' => 'array',
            'is_system' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByModule(Builder $query, string $module): Builder
    {
        return $query->where('module', $module);
    }

    public function scopeByAction(Builder $query, string $action): Builder
    {
        return $query->where('action', $action);
    }

    public function scopeByLevel(Builder $query, string $level): Builder
    {
        return $query->where('level', $level);
    }

    public function scopeSystem(Builder $query): Builder
    {
        return $query->where('is_system', true);
    }

    public function scopeUserActions(Builder $query): Builder
    {
        return $query->where('is_system', false);
    }

    public static function log(string $action, string $module, array $data = []): self
    {
        $actor = static::resolveActor();

        return static::create(array_merge([
            'action' => $action,
            'module' => $module,
            'user_id' => $actor?->id,
            'user_role' => $actor?->role?->name,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
        ], $data));
    }

    /*=========================================
    | ACTOR RESOLUTION (MULTI-GUARD)
    ==========================================*/
    protected static function resolveActor(): ?User
    {
        foreach (array_keys(config('auth.guards', [])) as $guard) {
            if ($user = Auth::guard($guard)->user()) {
                return $user;
            }
        }

        return null;
    }
}
