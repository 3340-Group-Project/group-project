<!-- php file that will handle DB schema and migration for for settings information -->
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); /* unique identifier for the setting record */
            $table->string('key')->unique(); /* unique string key to identify the setting name */
            $table->string('value')->nullable(); /* optional field to store the setting value or theme data */
            $table->timestamps(); /* timestamps for when the setting was created or last updated */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};