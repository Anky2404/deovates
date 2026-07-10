<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareerApplication extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'career_id',
        'department_id',
        'resume_id',
        'full_name',
        'email',
        'phone',
        'cover_letter',
        'portfolio_url',
        'current_company',
        'current_ctc',
        'expected_ctc',
        'notice_period',
        'status',
        'source',
        'admin_notes',
        'ip_address',
        'user_agent',
        'applied_at',
    ];

    protected function casts(): array
    {
        return [
            'current_ctc'      => 'integer',
            'expected_ctc'     => 'integer',
            'notice_period'    => 'integer',
            'applied_at'       => 'datetime',
        ];
    }

    /** -------------------------
     *  Relationships
     * ------------------------*/

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(ApplicationStatus::class, 'career_application_id');
    }

    /** -------------------------
     *  Scopes
     * ------------------------*/

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }

    public function scopeShortlisted(Builder $query): Builder
    {
        return $query->where('status', 'shortlisted');
    }

    /** -------------------------
     *  Helpers
     * ------------------------*/

    public function updateStatus(string $status, ?int $changedBy = null, ?string $remarks = null): void
    {
        $oldStatus = $this->status;

        // update status
        $this->update(['status' => $status]);

        // create status log entry
        $this->statusLogs()->create([
            'old_status'   => $oldStatus,
            'new_status'   => $status,
            'changed_by'   => $changedBy,
            'remarks'      => $remarks,
        ]);
    }
}
