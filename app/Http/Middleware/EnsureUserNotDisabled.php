<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace App\Http\Middleware;

use App\Support\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserNotDisabled
{
    // disabledEmailsFromEnv(): controller/middleware handler.
    private function disabledEmailsFromEnv(): array
    {
        $raw = (string) env('DISABLED_EMAILS', '');
        $emails = array_filter(array_map('trim', explode(',', $raw)));
        return array_values(array_unique(array_map(fn($e) => strtolower($e), $emails)));
    }
    // handle(): controller/middleware handler.
    public function handle(Request $request, Closure $next): Response
    {
        // We block disabled users from private pages.
        // Supports DB flag (is_disabled) OR .env DISABLED_EMAILS OR file list (disabled_emails).

        $user = Auth::user();
        if (!$user) return $next($request);

        if (isset($user->is_disabled) && (bool) $user->is_disabled) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been disabled. Please contact an administrator.',
            ]);
        }

        $email = strtolower((string) ($user->email ?? ''));

        if ($email !== '' && in_array($email, $this->disabledEmailsFromEnv(), true)) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been disabled. Please contact an administrator.',
            ]);
        }

        if ($email !== '' && in_array($email, SiteSettings::getDisabledEmails(), true)) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been disabled. Please contact an administrator.',
            ]);
        }

        return $next($request);
    }
}