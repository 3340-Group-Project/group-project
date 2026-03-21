<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'Introduction to Algorithms', /* title of the book */
                'user_id' => 1, /** associated user id for the listing */
                'price_cents' => 5000, /* price stored in cents */
                'is_sold' => false, /* availability status */
                'course_code' => 'COMP 3340', /* associated course code */
                'cover_image_path' => 'defaults/book.png', /* path to the book cover image */
                'format' => 'Hardcover', /* physical format of the book */
                'condition' => 'New', /* physical condition of the book */
                'created_at' => now(), /* record creation timestamp */
                'updated_at' => now(), /* record update timestamp */
            ],
            [
                'title' => 'Database Systems: The Complete Book',
                'user_id' => 1,
                'price_cents' => 4000,
                'is_sold' => false,
                'course_code' => 'COMP 3380',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Operating System Concepts',
                'user_id' => 1,
                'price_cents' => 3500,
                'is_sold' => false,
                'course_code' => 'COMP 3430',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Hardcover',
                'condition' => 'Used',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Artificial Intelligence: A Modern Approach',
                'user_id' => 1,
                'price_cents' => 6000,
                'is_sold' => false,
                'course_code' => 'COMP 4710',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Hardcover',
                'condition' => 'New',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean Code',
                'user_id' => 1,
                'price_cents' => 2500,
                'is_sold' => false,
                'course_code' => 'COMP 2150',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'user_id' => 1,
                'price_cents' => 4500,
                'is_sold' => false,
                'course_code' => 'COMP 2140',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Like New',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'user_id' => 1,
                'price_cents' => 5500,
                'is_sold' => false,
                'course_code' => 'COMP 3450',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Hardcover',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'user_id' => 1,
                'price_cents' => 3800,
                'is_sold' => false,
                'course_code' => 'COMP 2150',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Used',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Structure and Interpretation of Computer Programs',
                'user_id' => 1,
                'price_cents' => 4200,
                'is_sold' => false,
                'course_code' => 'COMP 3380',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Hardcover',
                'condition' => 'New',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Introduction to the Theory of Computation',
                'user_id' => 1,
                'price_cents' => 4700,
                'is_sold' => false,
                'course_code' => 'COMP 3400',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Good',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Algorithms Unlocked',
                'user_id' => 1,
                'price_cents' => 3200,
                'is_sold' => false,
                'course_code' => 'COMP 3340',
                'cover_image_path' => 'defaults/book.png',
                'format' => 'Paperback',
                'condition' => 'Like New',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}