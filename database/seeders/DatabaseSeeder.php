<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1) Basis accounts (deterministisch, handig voor demo/assessment)
        |--------------------------------------------------------------------------
        */

        // Test Patient user
        $testUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'rolename' => 'patient',
                'password' => bcrypt('password'),
            ]
        );

        // Create person + patient if missing
        if (!$testUser->person) {
            $person = \App\Models\Person::factory()->create(['user_id' => $testUser->id]);
            \App\Models\Patient::factory()->create(['person_id' => $person->id]);
        }

        // Praktijkmanagement user
        $pmUser = User::firstOrCreate(
            ['email' => 'pm@example.com'],
            [
                'name' => 'Praktijk Manager',
                'rolename' => 'praktijkmanagement',
                'password' => bcrypt('password'),
            ]
        );

        if (!$pmUser->person) {
            \App\Models\Person::factory()->create(['user_id' => $pmUser->id]);
        }

        // Tandarts user
        $tandartsUser = User::firstOrCreate(
            ['email' => 'tandarts@example.com'],
            [
                'name' => 'Tandarts',
                'rolename' => 'tandarts',
                'password' => bcrypt('password'),
            ]
        );

        if (!$tandartsUser->person) {
            $person = \App\Models\Person::factory()->create(['user_id' => $tandartsUser->id]);
            \App\Models\Employee::factory()->create([
                'person_id' => $person->id,
                // als je factory dit veld ondersteunt:
                // 'employee_type' => 'Tandarts',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 2) Extra fake data (optioneel: voor schermen met lijstjes)
        |--------------------------------------------------------------------------
        */
        \App\Models\Person::factory(100)->create();
        \App\Models\Patient::factory(100)->create();
        \App\Models\Employee::factory(2)->create();

        /*
        |--------------------------------------------------------------------------
        | 3) Jouw bestaande seeders (zoals je al had)
        |--------------------------------------------------------------------------
        */
        $this->call([
            OmzetSeeder::class,
            InvoiceSeeder::class,
            AppointmentSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4) Verkomende behandelingen scenario seeders
        |    Kies 1 (happy of unhappy). Voor beoordeling is happy meestal default.
        |--------------------------------------------------------------------------
        */

        // ✅ Happy scenario: er zijn verkomende behandelingen
        $this->call(HappyVerkomendeBehandelingenSeeder::class);

        // ❌ Unhappy scenario: geen verkomende behandelingen
        // $this->call(UnhappyVerkomendeBehandelingenSeeder::class);
    }
}
