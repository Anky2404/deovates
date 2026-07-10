<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'full_name',
        'email',
        'phone',
        'location',
        'resume_file',
        'portfolio_url',
        'linkedin_url',
        'github_url',
        'skills',
        'experience_years',
        'current_role',
        'current_company',
        'expected_salary',
        'notice_period',
        'source',
        'status',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'experience_years' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}
