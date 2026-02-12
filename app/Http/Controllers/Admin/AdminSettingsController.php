<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function editTheme()
    {
        $current = Setting::get('site_theme', 'default');

        return view('admin.settings.theme', [
            'current' => $current,
            'themes' => ['default', 'dark', 'seasonal'],
        ]);
    }

    public function updateTheme(Request $request)
    {
        $data = $request->validate([
            'theme' => ['required', 'in:default,dark,seasonal'],
        ]);

        Setting::set('site_theme', $data['theme']);

        return back()->with('status', 'Theme updated.');
    }
}
