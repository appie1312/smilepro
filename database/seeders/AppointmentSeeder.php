<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        // Alleen appointments leegmaken (veilig)
        DB::table('appointments')->truncate();

        // PATIENT
        $patient = User::firstOrCreate(
            ['email' => 'patient@test.nl'],
            [
                'name' => 'Jan Jansen',
                'rolename' => 'Patient',
                'password' => bcrypt('password'),
            ]
        );

        DB::table('people')->updateOrInsert(
            ['user_id' => $patient->id],
            [
                'voornaam' => 'Jan',
                'tussenvoegsel' => null,
                'achternaam' => 'Jansen',
                'geboortedatum' => '2000-01-01',
                'is_actief' => 1,
                'opmerking' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // BEHANDELAREN (4 verschillende)
        $behandelaren = [
            ['Sophie', 'de', 'Vries', 'sophie@test.nl'],
            ['Mark', null, 'Bakker', 'mark@test.nl'],
            ['Emma', null, 'Smit', 'emma@test.nl'],
            ['Lucas', 'van', 'Dijk', 'lucas@test.nl'],
        ];

        $dentistIds = [];

        foreach ($behandelaren as $b) {
            $user = User::firstOrCreate(
                ['email' => $b[3]],
                [
                    'name' => trim($b[0] . ' ' . ($b[1] ? $b[1] . ' ' : '') . $b[2]),
                    'rolename' => 'Tandarts',
                    'password' => bcrypt('password'),
                ]
            );

            DB::table('people')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'voornaam' => $b[0],
                    'tussenvoegsel' => $b[1],
                    'achternaam' => $b[2],
                    'geboortedatum' => '1985-01-01',
                    'is_actief' => 1,
                    'opmerking' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $dentistIds[] = $user->id; // dentist_id = USER id in jouw appointments tabel
        }

        // 8 afspraken (meer dan 3) en verschillende tandartsen
        $dagen = [1, 2, 3, 4, 5, 6, 7, 8];

        foreach ($dagen as $i => $dag) {
            DB::table('appointments')->insert([
                'patient_id' => $patient->id,
                'dentist_id' => $dentistIds[$i % count($dentistIds)],
                'date' => now()->addDays($dag)->toDateString(),
                'status' => 'Bevestigd',
                'is_actief' => 1,
                'opmerking' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
