<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complains>
 */
class ComplainsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "from" => fake()->numberBetween(2, 21),
            "complain" => fake()->text(400),
            "resolved" => fake()->boolean(),
        ];
    }
}
