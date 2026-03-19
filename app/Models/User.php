<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Support\SiteSettings;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_admin',
        'is_disabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    // casts(): controller/middleware handler.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // books(): controller/middleware handler.
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    // serviceRequests(): controller/middleware handler.
    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     * Centralized admin check so Blade/UI and middleware stay consistent.
     */
    // isAdmin(): controller/middleware handler.
    public function isAdmin(): bool
    {
        if (isset($this->is_admin) && (bool) $this->is_admin) {
            return true;
        }

        $email = strtolower((string) ($this->email ?? ''));
        if ($email === '') {
            return false;
        }

        $raw = (string) env('ADMIN_EMAILS', '');
        $emails = array_filter(array_map('trim', explode(',', $raw)));
        $emails = array_values(array_unique(array_map(fn($e) => strtolower($e), $emails)));

        if (in_array($email, $emails, true)) {
            return true;
        }

        return in_array($email, SiteSettings::getAdminEmails(), true);
    }
}