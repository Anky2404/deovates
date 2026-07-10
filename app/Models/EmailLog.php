<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailLog extends Model
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'uuid',
        'to_email',
        'to_name',
        'from_email',
        'from_name',
        'subject',
        'body',
        'template_id',
        'status',
        'retry_count',
        'sent_at',
        'error_message',
        'message_id',
        'source',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'retry_count' => 'integer',
        ];
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(EmailTemplate::class, 'template_id');
    }

    public function scopeSent(Builder $query): Builder
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed(Builder $query): Builder
    {
        return $query->where('status', 'failed');
    }

    public function scopeQueued(Builder $query): Builder
    {
        return $query->where('status', 'queued');
    }
}
