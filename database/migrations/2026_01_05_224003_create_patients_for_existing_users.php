<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\User;
use App\Models\Person;
use App\Models\Patient;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create patients for existing users with rolename 'patient'
        $patientUsers = User::where('rolename', 'patient')->get();

        foreach ($patientUsers as $user) {
            // Create person record
            $person = Person::create([
                'user_id' => $user->id,
                'voornaam' => explode(' ', $user->name)[0] ?? 'Onbekend',
                'achternaam' => explode(' ', $user->name)[1] ?? 'Onbekend',
                'geboortedatum' => now()->subYears(30), // Default age
                'is_actief' => true,
            ]);

            // Create patient record
            Patient::create([
                'person_id' => $person->id,
                'nummer' => 'P' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                'is_actief' => true,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove patients and persons created for users
        $patientUsers = User::where('rolename', 'patient')->get();

        foreach ($patientUsers as $user) {
            if ($user->person) {
                $user->person->patient()->delete();
                $user->person->delete();
            }
        }
    }
};
