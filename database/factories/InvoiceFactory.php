<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dueDate = $this->faker->dateTimeBetween('now', '+30 days');
        return [
            'patient_id' => 1, // Assume user id 1
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['paid', 'unpaid', 'overdue']),
            'due_date' => $dueDate->format('Y-m-d'),
            'description' => $this->faker->optional()->sentence,
        ];
    }
}
