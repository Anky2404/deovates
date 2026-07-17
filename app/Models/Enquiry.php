<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'type',
        'name',
        'email',
        'phone',
        'company_name',
        'subject',
        'message',
        'project_budget',
        'project_timeline',
        'service_interest',
        'source',
        'status',
        'is_read',
        'read_at',
        'assigned_to',
        'follow_up_at',
        'admin_notes',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'follow_up_at' => 'datetime',
            'is_read' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->update(['is_read' => true, 'read_at' => now()]);
        }
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeRequiresFollowUp(Builder $query): Builder
    {
        return $query->whereNotNull('follow_up_at')
            ->where('follow_up_at', '<=', now())
            ->whereNotIn('status', ['converted', 'closed', 'spam']);
    }

    public function markAsSpam(): void
    {
        $this->update(['status' => 'spam']);
    }
}
