<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // Default to null, can be overridden
            'voornaam' => $this->faker->firstName,
            'achternaam' => $this->faker->lastName,
            'geboortedatum' => $this->faker->date('Y-m-d', '-18 years'),
            'geslacht' => $this->faker->randomElement(['M', 'V']),
            'adres' => $this->faker->address,
            'telefoonnummer' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
