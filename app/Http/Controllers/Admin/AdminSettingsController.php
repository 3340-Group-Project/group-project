<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    // NOTE: editTheme() handles this route/action.
    public function editTheme()
    {
        return view('admin.settings.theme', [
            'current' => SiteSettings::getTheme('default'),
            'themes' => ['default', 'dark', 'seasonal'],
        ]);
    }

    // NOTE: updateTheme() handles this route/action.
    public function updateTheme(Request $request)
    {
        $data = $request->validate([
            'theme' => ['required', 'in:default,dark,seasonal'],
        ]);

                // Save theme to JSON settings file.
SiteSettings::setTheme($data['theme']);

        return back()->with('status', 'Theme updated.');
    }
}