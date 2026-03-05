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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            /** make user id FK */
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('course_code'); /** added course code as required */
            $table->string('author')->nullable();
            $table->string('isbn')->nullable();
            $table->string('format')->nullable();
            $table->string('condition')->nullable();
            $table->integer('price_cents');
            $table->text('description')->nullable();
            $table->string('cover_image_path'); /** added cover as required */
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
