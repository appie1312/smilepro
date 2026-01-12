<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'medewerker_type' => $this->faker->randomElement(['Assistent', 'Mondhygiënist', 'Tandarts', 'Praktijkmanagement']),
            'specialisatie' => $this->faker->optional()->word,
            'startdatum' => $this->faker->date('Y-m-d', '-5 years'),
            'einddatum' => $this->faker->optional(0.1)->date('Y-m-d'), // 10% chance
            'opmerking' => $this->faker->optional()->sentence,
        ];
    }
}
