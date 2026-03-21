<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers;

use App\Support\SiteSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    // NOTE: index() handles this route/action.
    public function index()
    {
        $checks = [];

        // DB
        try {
                        // DB ping query.
DB::select('select 1');
            $checks['database'] = ['ok' => true, 'message' => 'Connected'];
        } catch (\Throwable $e) {
            $checks['database'] = ['ok' => false, 'message' => $e->getMessage()];
        }

        // Storage
        try {
                        // Storage write/delete test.
$disk = Storage::disk('public');
            $testPath = 'status_check.txt';
            $disk->put($testPath, 'ok');
            $disk->delete($testPath);
            $checks['storage_public'] = ['ok' => true, 'message' => 'Writable'];
        } catch (\Throwable $e) {
            $checks['storage_public'] = ['ok' => false, 'message' => $e->getMessage()];
        }

        // Theme setting reachable
        try {
            $theme = SiteSettings::getTheme('default');

            $checks['theme_setting'] = ['ok' => true, 'message' => "Current: {$theme}"];
        } catch (\Throwable $e) {
            $checks['theme_setting'] = ['ok' => false, 'message' => $e->getMessage()];
        }

        return view('status', ['checks' => $checks]);
    }
}