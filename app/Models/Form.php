<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'form_type',
        'action',
        'heading',
        'paragraph',
        'style',
        'heading_align',
        'settings',
        'has_captcha',
        'send_email',
        'success_message',
        'redirect_url',
        'is_active',
        'display_order',
        'submissions_count',
    ];

    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'has_captcha' => 'boolean',
            'send_email' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'integer',
            'submissions_count' => 'integer',
        ];
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('sort_order');
    }

    public function templates(): BelongsToMany
    {
        return $this->belongsToMany(Template::class, 'template_forms')
            ->withPivot('is_active', 'display_order', 'position', 'section_slug')
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function incrementSubmissions(): void
    {
        $this->increment('submissions_count');
    }
}
