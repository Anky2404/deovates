<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function (Model $model) {
            $source = $model->slugSource ?? 'name';
            $value = $model->slug ?: $model->{$source} ?? null;

            if (empty($value)) {
                return;
            }

            $model->slug = static::uniqueSlug($value, $model);
        });
    }

    public static function uniqueSlug(string $value, ?Model $ignore = null): string
    {
        $slug = Str::slug($value);
        $candidate = $slug;
        $suffix = 1;

        $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive(static::class));

        while (
            ($usesSoftDeletes ? static::withTrashed() : static::query())
                ->where('slug', $candidate)
                ->when(
                    $ignore && $ignore->exists,
                    fn ($query) => $query->where($ignore->getKeyName(), '!=', $ignore->getKey())
                )
                ->exists()
        ) {
            $candidate = $slug . '-' . ++$suffix;
        }

        return $candidate;
    }
}
