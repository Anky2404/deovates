<?php

namespace App\Models;

use App\Services\EmailSenderService;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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

        if ($oldStatus !== $status) {
            $this->sendStatusUpdateEmail($oldStatus, $status, $remarks);
        }
    }

    /**
     * Notifies the applicant on every status change, using the same
     * database-template pattern as the password-reset email — the
     * template auto-creates itself from the fallback view on first use
     * and is fully editable afterward from Admin > Emails > Templates.
     */
    private function sendStatusUpdateEmail(?string $oldStatus, string $newStatus, ?string $remarks): void
    {
        try {
            app(EmailSenderService::class)->sendTemplated(
                toEmail: $this->email,
                toName: $this->full_name,
                templateSlug: 'career-application-status-update',
                templateDefaults: [
                    'name' => 'Career Application — Status Update',
                    'subject' => 'Your application for {{career_title}} — {{new_status}}',
                    'body' => view('emails.notification', [
                        'intro' => 'There\'s an update on your application for <strong>{{career_title}}</strong>.',
                        'fields' => [
                            'Previous Status' => '{{old_status}}',
                            'New Status' => '{{new_status}}',
                        ],
                        'quote' => '{{remarks}}',
                        'outro' => 'Thank you for your interest in joining {{app_name}}. We\'ll keep you posted as things progress.',
                        'signoff' => 'Best regards,<br>{{app_name}} Hiring Team',
                    ])->render(),
                    'variables' => ['name', 'career_title', 'old_status', 'new_status', 'remarks', 'app_name'],
                    'module' => 'careers',
                ],
                variables: [
                    'name' => e($this->full_name),
                    'career_title' => e($this->career?->title ?? 'the role'),
                    'old_status' => $oldStatus ? ucfirst($oldStatus) : '—',
                    'new_status' => ucfirst($newStatus),
                    'remarks' => $remarks ? nl2br(e($remarks)) : '',
                    'app_name' => config('constants.BUSINESS.name'),
                ],
                source: 'career-application-status',
                mailableClass: \App\Mail\CareerApplicationStatusUpdateMail::class,
            );
        } catch (\Throwable $e) {
            Log::error('Career application status email failed: ' . $e->getMessage(), ['exception' => $e]);
        }
    }
}
