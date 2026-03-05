<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Support\SiteSettings;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share theme globally; file-based so it works even before DB is finalized.
        View::share('siteTheme', SiteSettings::getTheme('default'));
    }
}
