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
        Schema::table('service_requests', function (Blueprint $table) {
            // Add status if it doesn't exist
            if (!Schema::hasColumn('service_requests', 'status')) {
                $table->string('status')->default('pending');
            }
            
            // Add admin_response if it doesn't exist
            if (!Schema::hasColumn('service_requests', 'admin_response')) {
                $table->text('admin_response')->nullable();
            }
            
            // Add responded_by if it doesn't exist
            if (!Schema::hasColumn('service_requests', 'responded_by')) {
                $table->foreignId('responded_by')->nullable()->constrained('users')->nullOnDelete();
            }
            
            // Add responded_at if it doesn't exist
            if (!Schema::hasColumn('service_requests', 'responded_at')) {
                $table->timestamp('responded_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_response', 'responded_by', 'responded_at']);
        });
    }
};
