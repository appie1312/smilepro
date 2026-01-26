<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HappyVerkomendeBehandelingenSeeder extends Seeder
{
    public function run(): void
    {
        // Alleen appointments leegmaken
        DB::table('Appointment')->truncate();

        // bestaande medewerker gebruiken
        $medewerkerId = DB::table('medewerker')->value('id');

        if (!$medewerkerId) {
            throw new \Exception('Geen medewerker gevonden');
        }

        DB::table('appointment')->insert([
            'medewerkerid' => $medewerkerId,
            'patientid' => 1,
            'datum' => now()->addDays(2)->toDateString(),
            'tijd' => '10:00:00',
            'status' => 'Bevestigd',
            'isactief' => 1,
            'datumaangemaakt' => now(),
            'datumgewijzigd' => now(),
        ]);
    }
}
