<?php

namespace App\Http\Middleware;

use App\Support\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    private function adminEmailsFromEnv(): array
    {
        $raw = (string) env('ADMIN_EMAILS', '');
        $emails = array_filter(array_map('trim', explode(',', $raw)));
        return array_values(array_unique(array_map(fn($e) => strtolower($e), $emails)));
    }

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user) abort(403);

        if (isset($user->is_admin) && (bool) $user->is_admin) {
            return $next($request);
        }

        $email = strtolower((string) ($user->email ?? ''));

        if ($email !== '' && in_array($email, $this->adminEmailsFromEnv(), true)) {
            return $next($request);
        }

        if ($email !== '' && in_array($email, SiteSettings::getAdminEmails(), true)) {
            return $next($request);
        }

        abort(403);
    }
}
