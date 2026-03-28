<!-- php file that will handle DB schema and migration for service request data  -->
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
        
        if (!Schema::hasTable('service_requests')) {
            Schema::create('service_requests', function (Blueprint $table) {
                $table->id(); /* unique identifier for the service request */
                /** make user id the FK and delete requests if user is removed */
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->string('subject'); /* required field for the subject of the request */
                $table->text('message'); /* required field for the detailed request message */
                $table->string('status')->default('pending')->after('message');
                $table->text('admin_response')->nullable();
                $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamp('responded_at')->nullable();
                $table->string('attachment_path')->nullable(); /* optional field for a file attachment path */
                $table->timestamps(); /* timestamps for when the request was submitted or updated */


            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests'); /* drops the table if the migration is rolled back */
    }
};