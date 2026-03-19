<?php
// NOTE: File-level comments describe purpose only (no logic change).

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // run(): controller/middleware handler.
    public function run(): void
    {
        \DB::table('books')->insert([
            [
                'title' => 'Introduction to Algorithms',
                'price_cents' => 5000,
                'is_sold' => false,
                'course_code' => 'COMP 3340',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Database Systems: The Complete Book',
                'price_cents' => 4000,
                'is_sold' => false,
                'course_code' => 'COMP 3380',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Operating System Concepts',
                'price_cents' => 3500,
                'is_sold' => false,
                'course_code' => 'COMP 3430',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'price_cents' => 6000,
                'is_sold' => false,
                'course_code' => 'COMP 4710',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean Code',
                'price_cents' => 2500,
                'is_sold' => false,
                'course_code' => 'COMP 2150',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'price_cents' => 4500,
                'is_sold' => false,
                'course_code' => 'COMP 2140',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'price_cents' => 5500,
                'is_sold' => false,
                'course_code' => 'COMP 3450',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'price_cents' => 3800,
                'is_sold' => false,
                'course_code' => 'COMP 2150',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Structure and Interpretation of Computer Programs',
                'price_cents' => 4200,
                'is_sold' => false,
                'course_code' => 'COMP 3380',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Introduction to the Theory of Computation',
                'price_cents' => 4700,
                'is_sold' => false,
                'course_code' => 'COMP 3400',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Algorithms Unlocked',
                'price_cents' => 3200,
                'is_sold' => false,
                'course_code' => 'COMP 3340',
                'cover_image_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}