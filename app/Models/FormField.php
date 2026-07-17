<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormField extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'form_id',
        'name',
        'label',
        'type',
        'is_multiple',
        'group_key',
        'enable_croppie',
        'field_id',
        'class',
        'required',
        'disabled',
        'use_ck_editor',
        'add_country_code',
        'placeholder',
        'field_width',
        'default_value',
        'validation_rules',
        'options',
        'conditions',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'conditions' => 'array',
            'required' => 'boolean',
            'disabled' => 'boolean',
            'use_ck_editor' => 'boolean',
            'add_country_code' => 'boolean',
            'enable_croppie' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    public function scopeRequired(Builder $query): Builder
    {
        return $query->where('required', true);
    }
}
