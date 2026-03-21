<!-- php file that will handle DB schema and migration for user information -->

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
            $table->id(); /* PK for user id */
            $table->string('name'); /* required field for name of user */
            $table->string('email')->unique(); /* required and unique email for each user */
            $table->string('phone')->nullable()->unique(); /** optional and unique phone number for user */
            $table->string('password'); /* required field for password */
            $table->timestamps(); /* timestamp for when user was created */
        });
    }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('users');
    // }
};
