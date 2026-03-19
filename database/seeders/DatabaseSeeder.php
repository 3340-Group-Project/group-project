<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // run(): controller/middleware handler.
    public function run(): void
    {
        $this->call([
            BookSeeder::class,
        ]);
    }
}