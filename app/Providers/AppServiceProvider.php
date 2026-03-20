<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Support\SiteSettings;

class AppServiceProvider extends ServiceProvider
{
    // register(): controller/middleware handler.
    public function register(): void
    {
        //
    }
    // boot(): controller/middleware handler.
    public function boot(): void
    {
        // Share the theme name to ALL pages so the layout can load the right CSS.

        // Share theme globally; file-based so it works even before DB is finalized.
        View::share('siteTheme', SiteSettings::getTheme('default'));
    }
}