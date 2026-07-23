<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AuthLog extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'event',
        'ip_address',
        'user_agent',
        'device',
        'platform',
        'browser',
        'location',
        'is_success',
        'failure_reason',
    ];

    protected function casts(): array
    {
        return [
            'is_success' => 'boolean',
        ];
    }

    /*=========================================
    | RELATIONS
    ==========================================*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*=========================================
    | SCOPES
    ==========================================*/
    public function scopeSuccessful(Builder $query): Builder
    {
        return $query->where('is_success', true);
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('is_success', false);
    }

    public function scopeByEvent(Builder $query, string $event): Builder
    {
        return $query->where('event', $event);
    }

    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /*=========================================
    | PARSERS (DEVICE / PLATFORM / BROWSER)
    ==========================================*/
    public static function detectDevice(): ?string
    {
        $ua = request()->userAgent();

        if (! $ua) {
            return null;
        }

        if (stripos($ua, 'Mobile') !== false) {
            return 'Mobile';
        }
        if (stripos($ua, 'Tablet') !== false) {
            return 'Tablet';
        }

        return 'Desktop';
    }

    public static function detectPlatform(): ?string
    {
        $ua = request()->userAgent();

        if (! $ua) {
            return null;
        }

        return match (true) {
            stripos($ua, 'Windows') !== false => 'Windows',
            stripos($ua, 'Mac OS') !== false,
            stripos($ua, 'Macintosh') !== false => 'Mac',
            stripos($ua, 'Linux') !== false => 'Linux',
            stripos($ua, 'Android') !== false => 'Android',
            stripos($ua, 'iPhone') !== false,
            stripos($ua, 'iPad') !== false => 'iOS',
            default => null,
        };
    }

    public static function detectBrowser(): ?string
    {
        $ua = request()->userAgent();

        if (! $ua) {
            return null;
        }

        return match (true) {
            stripos($ua, 'Firefox') !== false => 'Firefox',
            stripos($ua, 'Chrome') !== false && stripos($ua, 'Edg') === false => 'Chrome',
            stripos($ua, 'Edg') !== false => 'Microsoft Edge',
            stripos($ua, 'Safari') !== false && stripos($ua, 'Chrome') === false => 'Safari',
            stripos($ua, 'Opera') !== false || stripos($ua, 'OPR') !== false => 'Opera',
            default => null,
        };
    }

    /*=========================================
    | STATIC EVENT LOGGER
    ==========================================*/
    public static function logEvent(
        string $event,
        ?int $userId = null,
        bool $success = true,
        ?string $failureReason = null
    ): self {

        if ($userId === null) {
            foreach (array_keys(config('auth.guards', [])) as $guard) {
                if ($user = Auth::guard($guard)->user()) {
                    $userId = $user->id;
                    break;
                }
            }
        }

        return static::create([
            'user_id' => $userId,
            'event' => $event,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'device' => self::detectDevice(),
            'platform' => self::detectPlatform(),
            'browser' => self::detectBrowser(),
            'location' => request()->header('CF-IPCountry') ?? null,
            'is_success' => $success,
            'failure_reason' => $failureReason,
        ]);
    }
}
