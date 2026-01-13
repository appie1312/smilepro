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
        Schema::table('people', function (Blueprint $table) {
            $table->enum('geslacht', ['M', 'V'])->nullable();
            $table->text('adres')->nullable();
            $table->string('telefoonnummer')->nullable();
            $table->string('email')->unique()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['geslacht', 'adres', 'telefoonnummer', 'email']);
        });
    }
};
