<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('omzetten', function (Blueprint $table) {
$table->id();
$table->string('omschrijving'); // bv. "Omzet per klant"
$table->string('klant_naam'); // bv. Patient naam
$table->date('datum');
$table->decimal('bedrag', 10, 2);
$table->timestamps();

$table->index('datum');
});
}

public function down(): void
{
Schema::dropIfExists('omzetten');
}
};