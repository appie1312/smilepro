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
        Schema::table('patients', function (Blueprint $table) {
            $table->string('verzekeringsnummer')->nullable();
            $table->string('verzekeraar')->nullable();
            $table->text('notities')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['verzekeringsnummer', 'verzekeraar', 'notities']);
        });
    }
};
