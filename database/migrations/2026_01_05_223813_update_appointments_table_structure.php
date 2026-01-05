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
        Schema::table('appointments', function (Blueprint $table) {
            // Drop old columns that are no longer needed
            $table->dropColumn([
                'customer_name',
                'appointment_date',
                'appointment_time',
                'with_whom',
                'phone',
                'address'
            ]);

            // Update existing status column to use enum
            $table->enum('status', ['Bevestigd', 'Geannuleerd'])->default('Bevestigd')->change();

            // Add missing columns
            $table->boolean('is_actief')->default(true);
            $table->text('opmerking')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Remove new columns
            $table->dropColumn(['is_actief', 'opmerking']);

            // Restore old columns
            $table->string('customer_name')->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('with_whom')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // Restore old status
            $table->string('status')->default('planned')->change();
        });
    }
};
