<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Custom Artisan command that prints a random inspiring quote.
Artisan::command('inspire', function () {
    // Output the quote text to the console.
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
