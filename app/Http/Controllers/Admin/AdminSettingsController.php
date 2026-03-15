<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function editTheme()
    {
        return view('admin.settings.theme', [
            'current' => SiteSettings::getTheme('default'),
            'themes' => ['default', 'dark', 'seasonal'],
        ]);
    }

    public function updateTheme(Request $request)
    {
        $data = $request->validate([
            'theme' => ['required', 'in:default,dark,seasonal'],
        ]);

        SiteSettings::setTheme($data['theme']);

        return back()->with('status', 'Theme updated.');
    }
}
