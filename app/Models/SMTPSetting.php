<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMTPSetting extends Model
{
    use HasUuid, SoftDeletes;

    protected $table = 'smtp_settings';

    protected $fillable = [
        'uuid',
        'name',
        'driver',
        'host',
        'port',
        'encryption',
        'username',
        'password',
        'from_email',
        'from_name',
        'options',
        'is_active',
        'is_default',
        'created_by',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'port' => 'integer',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'password' => 'encrypted',
        ];
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public static function getDefault(): ?self
    {
        return static::active()->default()->first();
    }
}
