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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique(); /** added phone as second contact method */
            $table->string('password');
            // NOTE: keep role/disable flags on the user row so admin actions update immediately in the DB.
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // NOTE: dropping the whole users table is fine here because this is the create-table migration.
        Schema::dropIfExists('users');
    }
};
