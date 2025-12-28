<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(0, 0, 9999999.),
            'payment_source' => fake()->randomElement(["online",'in-person']),
            'payment_method' => fake()->randomElement(["cash",'card']),
            'processed_by' => User::factory(),
            'transaction_id' => Transaction::factory(),
            'paied_at' => fake()->dateTime(),
        ];
    }
}
