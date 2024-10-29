<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FurparentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fname = $this->faker->firstName();
        $lname = $this->faker->lastName();
        return [
            'firstname' => $fname,
            'lastname' => $lname,
            'email' => $this->faker->unique()->safeEmail(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'password' => Hash::make('qqqqqqqq'), // Default static password, modify if necessary
            'img' => 'https://ui-avatars.com/api/?name=' . urlencode($fname.' '.$lname) . '&size=150', // Generates a random image URL
        ];
    }
}
