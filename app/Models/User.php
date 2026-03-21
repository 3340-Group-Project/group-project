<?php

// NOTE: Model defines DB fields (fillable), casts, and relationships.

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
    // NOTE: casts() converts DB values into booleans/dates automatically when User is loaded.
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_disabled' => 'boolean',
        ];
    }

    // NOTE: books() returns all listings that belong to this user.
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    // NOTE: serviceRequests() returns all service requests that belong to this user.
    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     * Centralized admin check so Blade/UI and middleware stay consistent.
     */
    // NOTE: isAdmin() prefers the DB column, but keeps env/file fallback for older setups.
    public function isAdmin(): bool
    {
        if ((bool) ($this->is_admin ?? false)) {
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

    // NOTE: isDisabled() gives one shared way to check disabled status across the app.
    public function isDisabled(): bool
    {
        return (bool) ($this->is_disabled ?? false);
    }
}
