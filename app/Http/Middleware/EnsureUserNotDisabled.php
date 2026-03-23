<?php

// NOTE: Middleware runs before the controller; it can block/redirect requests.

namespace App\Http\Middleware;

use App\Support\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserNotDisabled
{
    // Disabled check order: DB is_disabled -> .env DISABLED_EMAILS -> file disabled_emails.

    private function disabledEmailsFromEnv(): array
    {
        $raw = (string) env('DISABLED_EMAILS', '');
        $emails = array_filter(array_map('trim', explode(',', $raw)));
        return array_values(array_unique(array_map(fn($e) => strtolower($e), $emails)));
    }

    // NOTE: handle() blocks disabled users and logs them out right away.
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (! $user) {
            return $next($request);
        }

        // NOTE: the DB flag is the main source after adding the migration for is_disabled.
        if ($user->isDisabled()) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account has been disabled. Please contact an administrator.',
            ]);
        }

        $email = strtolower((string) ($user->email ?? ''));

        // NOTE: keep env/file checks for backward compatibility with older local setups.
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
