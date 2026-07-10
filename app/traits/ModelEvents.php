<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ModelEvents
{
    public static function bootModelEvent()
    {
        // Before creating a model
        static::creating(function ($model) {
            if (property_exists($model, 'uuid') && empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }

            if ($model->timestamps) {
                $now = now();
                $model->created_at = $model->created_at ?? $now;
                $model->updated_at = $model->updated_at ?? $now;
            }
        });

        // Before updating a model
        static::updating(function ($model) {
            if ($model->timestamps) {
                $model->updated_at = now();
            }
        });

        // Before soft deleting a model
        static::deleting(function ($model) {
            if (in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($model))) {
                $model->deleted_at = now();
            }
        });
    }
}
