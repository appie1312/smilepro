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
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'rolename' => 'patient',
        ]);

        // Create person and patient for test user
        $person = \App\Models\Person::factory()->create(['user_id' => $testUser->id]);
        \App\Models\Patient::factory()->create(['person_id' => $person->id]);

        // Create praktijkmanagement user
        $pmUser = User::factory()->create([
            'name' => 'Praktijk Manager',
            'email' => 'pm@example.com',
            'rolename' => 'praktijkmanagement',
        ]);

        // Create person for pm user
        \App\Models\Person::factory()->create(['user_id' => $pmUser->id]);

        // Create some fake data
        \App\Models\Person::factory(4)->create(); // 4 more persons without user
        \App\Models\Patient::factory(2)->create(); // 2 more patients
        \App\Models\Employee::factory(2)->create();
        // \App\Models\Appointment::factory(4)->create();

        // Existing
        $this->call([
            OmzetSeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}

