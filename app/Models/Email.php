<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'from_email',
        'from_name',
        'to_email',
        'to_name',
        'subject',
        'body',
        'type',
        'direction',
        'user_id',
        'enquiry_id',
        'status',
        'retry_count',
        'sent_at',
        'failure_reason',
        'source',
        'ip_address',
        'message_id',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'retry_count' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function enquiry(): BelongsTo
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function scopeSent(Builder $query): Builder
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', 'failed');
    }

    public function scopeOutgoing(Builder $query): Builder
    {
        return $query->where('direction', 'outgoing');
    }

    public function scopeIncoming(Builder $query): Builder
    {
        return $query->where('direction', 'incoming');
    }
}
