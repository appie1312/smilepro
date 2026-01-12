<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_availabilities', function (Blueprint $table) {
            $table->id();
            // Koppeling naar de medewerker
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Datumvanaf – Datumtotmet
            $table->date('date_from'); 
            $table->date('date_to');   
            
            // Tijdvanaf – Tijdtotmet
            $table->time('time_from'); 
            $table->time('time_to');   
            
            // Status (Aanwezig, Afwezig, Verlof, Ziek)
            $table->enum('status', ['Aanwezig', 'Afwezig', 'Verlof', 'Ziek']); 
            
            // Opmerking
            $table->text('comment')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_availabilities');
    }
};