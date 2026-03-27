<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's Admin users.
     */
    public function run(): void
    {
        $adminEmail = config('admin.email') ?? 'admin@uwindsor.ca';

        User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make(config('admin.password', 'password')),
                'is_admin' => true,
                'is_disabled' => false,
                'phone' => config('admin.phone', null)
            ]
        );
    }
}