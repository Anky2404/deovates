<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscriber extends Model
{
    use HasUuid, SoftDeletes;

    protected $table = 'newsletter_subscribers';

    protected $fillable = [
        'uuid',
        'email',
        'name',
        'is_active',
        'is_read',
        'read_at',
        'subscribed_at',
        'unsubscribed_at',
        'is_confirmed',
        'confirmed_at',
        'source',
        'ip_address',
        'user_agent',
        'emails_sent',
        'last_email_sent_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_read' => 'boolean',
            'read_at' => 'datetime',
            'is_confirmed' => 'boolean',
            'subscribed_at' => 'datetime',
            'unsubscribed_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'last_email_sent_at' => 'datetime',
            'emails_sent' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('is_confirmed', true);
    }

    public function scopeSubscribed(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('is_confirmed', true);
    }

    public function confirm(): void
    {
        $this->update(['is_confirmed' => true, 'confirmed_at' => now()]);
    }

    public function unsubscribe(): void
    {
        $this->update(['is_active' => false, 'unsubscribed_at' => now()]);
    }

    public function resubscribe(): void
    {
        $this->update(['is_active' => true, 'unsubscribed_at' => null]);
    }

    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->update(['is_read' => true, 'read_at' => now()]);
        }
    }
}
