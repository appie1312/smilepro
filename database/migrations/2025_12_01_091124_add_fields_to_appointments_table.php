<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // voeg deze velden alleen toe als ze nog niet bestaan
            $table->string('customer_name')->nullable();
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->string('with_whom')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'appointment_date',
                'appointment_time',
                'with_whom',
                'phone',
                'address',
            ]);
        });
    }
};
