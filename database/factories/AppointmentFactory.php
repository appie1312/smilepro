<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => \App\Models\User::factory()->create(['rolename' => 'patient'])->id,
            'dentist_id' => \App\Models\User::factory()->create(['rolename' => 'Tandarts'])->id,
            'date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            'status' => $this->faker->randomElement(['Bevestigd', 'Geannuleerd']),
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
