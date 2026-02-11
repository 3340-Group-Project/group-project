<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    public function index()
    {
        $checks = [];

        // DB
        try {
            DB::select('select 1');
            $checks['database'] = ['ok' => true, 'message' => 'Connected'];
        } catch (\Throwable $e) {
            $checks['database'] = ['ok' => false, 'message' => $e->getMessage()];
        }

        // Storage
        try {
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
            $theme = Setting::get('site_theme', 'default');
            $checks['theme_setting'] = ['ok' => true, 'message' => "Current: {$theme}"];
        } catch (\Throwable $e) {
            $checks['theme_setting'] = ['ok' => false, 'message' => $e->getMessage()];
        }

        return view('status', ['checks' => $checks]);
    }
}
