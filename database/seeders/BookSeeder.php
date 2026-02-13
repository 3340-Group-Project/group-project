<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('books')->insert([
            [
                'title' => 'Introduction to Algorithms',
                'price_dollars' => 50,
                'course_code' => 'COMP 3340',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Database Systems: The Complete Book',
                'price_dollars' => 40,
                'course_code' => 'COMP 3380',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Operating System Concepts',
                'price_dollars' => 35,
                'course_code' => 'COMP 3430',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'price_dollars' => 60,
                'course_code' => 'COMP 4710',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean Code',
                'price_dollars' => 25,
                'course_code' => 'COMP 2150',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
