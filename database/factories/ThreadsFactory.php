<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'threadID' => $this->faker->numberBetween(1, 1000),
            'recipientID1' => $this->faker->numberBetween(1, 1000),
            'recipientID2' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
