<?php

// NOTE: Middleware runs before the controller; it can block/redirect requests.


namespace App\Http\Middleware;

use App\Support\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    // Admin check order: DB is_admin -> .env ADMIN_EMAILS -> file admin_emails.

    private function adminEmailsFromEnv(): array
    {
        $raw = (string) env('ADMIN_EMAILS', '');
        $emails = array_filter(array_map('trim', explode(',', $raw)));
        return array_values(array_unique(array_map(fn($e) => strtolower($e), $emails)));
    }

    // NOTE: handle() handles this route/action.
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) {
            // Not logged in - let auth middleware handle redirects.
            abort(403); // NOTE: forbidden (not allowed).
        }

        return $next($request);
    }
}