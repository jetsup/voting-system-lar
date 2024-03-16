<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elections>
 */
class ElectionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "election_type" => 1,
            "start_date" => fake()->dateTimeBetween("-1 years", "2 years"),
            "end_date" => fake()->dateTimeBetween("-1 years", "2 years"),
            "election_status" => fake()->numberBetween(1, 5),
        ];
    }
}
