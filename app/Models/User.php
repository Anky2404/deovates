<?php

namespace App\Models;

use App\Mail\PasswordResetMail;
use App\Services\EmailSenderService;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuid, Notifiable, SoftDeletes;

    protected $fillable = [
        'uuid',
        'role_id',
        'department_id',
        'name',
        'email',
        'username',
        'phone',
        'avatar',
        'avatar_alt',
        'designation',
        'bio',
        'email_verified_at',
        'password',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function author(): HasMany
    {
        return $this->hasMany(Author::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function authLogs(): HasMany
    {
        return $this->hasMany(AuthLog::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(UserPermission::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(NotificationLog::class);
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->whereHas('role', fn ($q) => $q->whereNotIn('slug', ['super-admin', 'admin']));
    }

    // Helpers
    public function getRoleName(): ?string
    {
        return $this->role?->name;
    }

    public function hasRole(string $slug): bool
    {
        return $this->role?->slug === $slug;
    }

    public function isAdmin(): bool
    {
        return in_array($this->role?->slug, ['super-admin', 'admin']);
    }

    // Replaces Laravel's default generic reset-password email with the
    // site's own branded template (EmailTemplate slug "password-reset",
    // auto-created on first use so it's immediately editable from
    // Admin > Emails > Templates without any manual setup). Every send is
    // recorded in both the Emails table and the Email Logs table via
    // EmailSenderService::sendTemplated().
    public function sendPasswordResetNotification($token): void
    {
        $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $this->email], false));

        app(EmailSenderService::class)->sendTemplated(
            toEmail: $this->email,
            toName: $this->name,
            templateSlug: 'password-reset',
            templateDefaults: [
                'name' => 'Password Reset',
                'subject' => 'Reset Your {{app_name}} Password',
                'body' => view('emails.notification', [
                    'greeting' => 'Hello {{name}},',
                    'intro' => 'You are receiving this email because we received a password reset request for your account.',
                    'button' => ['url' => '{{reset_url}}', 'text' => 'Reset Password'],
                    'outro' => 'This password reset link will expire in 60 minutes.<br><br>If you did not request a password reset, no further action is required.',
                ])->render(),
                'variables' => ['name', 'reset_url', 'app_name'],
                'module' => 'auth',
            ],
            variables: [
                'name' => $this->name,
                'reset_url' => $resetUrl,
                'app_name' => config('constants.BUSINESS.name'),
            ],
            source: 'password-reset',
            mailableClass: PasswordResetMail::class,
        );
    }
}
