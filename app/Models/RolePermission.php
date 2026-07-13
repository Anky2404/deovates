<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    use HasUuid;

    protected $fillable = [
        'uuid',
        'role_id',
        'permission_id',
        'is_allowed',
        'conditions',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'conditions' => 'array',
            'meta' => 'array',
            'is_allowed' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
