<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'timestamp' => $this->faker->dateTime,
            'status' => $this->faker->randomElement([0, 1, 2]),
            'type' => $this->faker->randomElement(['deposit', 'withdraw']),
        ];
    }
}
