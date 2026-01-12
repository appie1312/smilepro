<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $testUser = User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'rolename' => 'patient',
            'password' => bcrypt('password'),
        ]);

        // Create person and patient for test user if not exists
        if (!$testUser->person) {
            $person = \App\Models\Person::factory()->create(['user_id' => $testUser->id]);
            \App\Models\Patient::factory()->create(['person_id' => $person->id]);
        }

        // Create praktijkmanagement user
        $pmUser = User::firstOrCreate([
            'email' => 'pm@example.com',
        ], [
            'name' => 'Praktijk Manager',
            'email' => 'pm@example.com',
            'rolename' => 'praktijkmanagement',
            'password' => bcrypt('password'),
        ]);

        // Create person for pm user if not exists
        if (!$pmUser->person) {
            \App\Models\Person::factory()->create(['user_id' => $pmUser->id]);
        }

        // Create tandarts user
        $tandartsUser = User::firstOrCreate([
            'email' => 'tandarts@example.com',
        ], [
            'name' => 'Tandarts',
            'email' => 'tandarts@example.com',
            'rolename' => 'Tandarts',
            'password' => bcrypt('password'),
        ]);

        if (!$tandartsUser->person) {
            $person = \App\Models\Person::factory()->create(['user_id' => $tandartsUser->id]);
            \App\Models\Employee::factory()->create(['person_id' => $person->id]);
        }

        // Create some fake data
        \App\Models\Person::factory(100)->create(); // 100 more persons without user
        \App\Models\Patient::factory(100)->create(); // 100 more patients
        \App\Models\Employee::factory(2)->create();
        // \App\Models\Appointment::factory(4)->create();

        // Existing
        $this->call([
            OmzetSeeder::class,
            InvoiceSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}

