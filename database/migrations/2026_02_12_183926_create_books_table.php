<!-- php file that will handle DB schema and migration for book listing information -->

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        if (!Schema::hasTable('books')) {
        Schema::create('books', function (Blueprint $table) {
                $table->id();
                /** make user id the FK */
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('title'); /* required field for title of book */
                $table->string('course_code'); /* required course code information */
                $table->string('author')->nullable(); /* optional field for author */
                $table->string('isbn')->nullable(); /* optional field for isbn */
                $table->string('format'); /* required field for book format */
                $table->string('condition'); /* required field for book condition */
                $table->integer('price_cents'); /* optional field for price */
                $table->text('description')->nullable(); /* optional field for book description */
                $table->string('cover_image_path'); /** required field for image of book */
                $table->boolean('is_sold')->default(false); /* boolean value to show if book has been sold or not */
                $table->timestamps(); /* time stamp from one book listing was made */
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
