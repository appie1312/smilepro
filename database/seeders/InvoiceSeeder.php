<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the test patient user
        $patientUser = \App\Models\User::where('email', 'test@example.com')->first();

        if (!$patientUser) {
            $patientUser = \App\Models\User::factory()->create([
                'name' => 'Test Patient',
                'email' => 'test@example.com',
                'rolename' => 'patient',
            ]);
            // Create person and patient if not exists
            $person = \App\Models\Person::factory()->create(['user_id' => $patientUser->id]);
            $patient = \App\Models\Patient::factory()->create(['person_id' => $person->id]);
        } else {
            $patient = $patientUser->person->patient ?? null;
            if (!$patient) {
                $person = \App\Models\Person::factory()->create(['user_id' => $patientUser->id]);
                $patient = \App\Models\Patient::factory()->create(['person_id' => $person->id]);
            }
        }

        // Create sample invoices for the patient
        \App\Models\Invoice::create([
            'patient_id' => $patient->id,
            'amount' => 150.00,
            'status' => 'unpaid',
            'due_date' => now()->addDays(30),
            'description' => 'Tandartscontrole en reiniging',
        ]);

        \App\Models\Invoice::create([
            'patient_id' => $patient->id,
            'amount' => 75.50,
            'status' => 'paid',
            'due_date' => now()->subDays(10),
            'description' => 'Vulling rechtsboven',
        ]);

        \App\Models\Invoice::create([
            'patient_id' => $patient->id,
            'amount' => 200.00,
            'status' => 'overdue',
            'due_date' => now()->subDays(5),
            'description' => 'Kroon behandeling',
        ]);
    }
}
