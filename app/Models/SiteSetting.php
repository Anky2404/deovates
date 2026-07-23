<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'group',
        'key',
        'value',
        'type',
        'label',
        'description',
        'options',
        'is_autoload',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_autoload' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeAutoload(Builder $query): Builder
    {
        return $query->where('is_autoload', true);
    }

    public function scopeByGroup(Builder $query, string $group): Builder
    {
        return $query->where('group', $group);
    }

    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->active()->first();

            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, $value): bool
    {
        $setting = static::withTrashed()->where('key', $key)->first();

        if ($setting) {
            if ($setting->trashed()) {
                $setting->restore();
            }

            $changed = $setting->value !== $value;
            $setting->update(['value' => $value]);
        } else {
            static::create(['key' => $key, 'value' => $value]);
            $changed = true;
        }

        Cache::forget("setting.{$key}");

        return $changed;
    }

    public function getTypedValueAttribute()
    {
        return match ($this->type) {
            'boolean' => (bool) $this->value,
            'integer' => (int) $this->value,
            'json', 'array' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}
