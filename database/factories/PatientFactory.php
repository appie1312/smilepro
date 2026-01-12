<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_id' => \App\Models\Person::factory(),
            'nummer' => $this->faker->unique()->numberBetween(1000, 9999),
            'verzekeringsnummer' => $this->faker->optional()->numerify('##########'),
            'verzekeraar' => $this->faker->optional()->company,
            'notities' => $this->faker->optional()->sentence,
        ];
    }
}
