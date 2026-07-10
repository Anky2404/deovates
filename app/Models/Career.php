<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'department_id',
        'title',
        'slug',
        'employment_type',
        'experience_level',
        'location',
        'is_remote',
        'openings',
        'salary_min',
        'salary_max',
        'salary_currency',
        'description',
        'responsibilities',
        'requirements',
        'benefits',
        'skills',
        'apply_url',
        'apply_email',
        'application_deadline',
        'meta_title',
        'meta_description',
        'is_active',
        'is_featured',
        'total_applications',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'is_remote' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'openings' => 'integer',
            'salary_min' => 'integer',
            'salary_max' => 'integer',
            'total_applications' => 'integer',
            'application_deadline' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(CareerApplication::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('application_deadline')
                ->orWhere('application_deadline', '>=', now()));
    }

    public function scopeRemote(Builder $query): Builder
    {
        return $query->where('is_remote', true);
    }

    public function isOpen(): bool
    {
        return $this->is_active && (!$this->application_deadline || $this->application_deadline >= now());
    }

    public function getSalaryRangeAttribute(): ?string
    {
        if (!$this->salary_min && !$this->salary_max) return null;
        if ($this->salary_min && $this->salary_max) {
            return "{$this->salary_currency} {$this->salary_min} - {$this->salary_max}";
        }
        return "{$this->salary_currency} " . ($this->salary_min ?: $this->salary_max);
    }
}
