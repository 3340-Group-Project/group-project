<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\SiteSettings;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    // editTheme(): controller/middleware handler.
    public function editTheme()
    {
        return view('admin.settings.theme', [
            'current' => SiteSettings::getTheme('default'),
            'themes' => ['default', 'dark', 'seasonal'],
        ]);
    }
    // updateTheme(): controller/middleware handler.
    public function updateTheme(Request $request)
    {
        // Theme is saved to a JSON file so we don't depend on DB being finished.

        $data = $request->validate([
            'theme' => ['required', 'in:default,dark,seasonal'],
        ]);

        SiteSettings::setTheme($data['theme']);

        return back()->with('status', 'Theme updated.');
    }
}