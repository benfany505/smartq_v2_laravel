<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentHistory>
 */
class PaymentHisrotyFatoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_number' => $this->faker->uuid,
            'payer_id' => $this->faker->uuid,
            'account' => $this->faker->uuid,
            'date' => $this->faker->dateTimeThisYear,
            'description' => $this->faker->sentence,
            'ammount' => $this->faker->randomFloat(2, 0, 100),
            'transaction_id' => $this->faker->uuid,
            'method' => $this->faker->sentence,
            'status' => $this->faker->sentence,
            'category' => $this->faker->sentence,

        ];
    }
}
