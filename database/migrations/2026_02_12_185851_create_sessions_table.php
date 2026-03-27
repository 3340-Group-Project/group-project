<!-- php file that will handle DB schema and migration for user session times  -->
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
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary(); /* unique session identifier as primary key */
                $table->foreignId('user_id')->nullable()->index(); /** optional user id link for authenticated sessions */
                $table->string('ip_address', 45)->nullable(); /* optional field for user ip address */
                $table->text('user_agent')->nullable(); /* optional field for browser and device information */
                $table->longText('payload'); /* required field to store serialized session data */
                $table->integer('last_activity')->index(); /* unix timestamp of the last user activity */
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};