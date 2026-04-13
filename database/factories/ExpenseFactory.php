<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'code_expense' => $this->faker->numerify('#############'),
            'date_expense' => $this->faker->dateTimeBetween('-6 months', '-8 days'),
            'amount' => $this->faker->randomElement([
                10000, 75000, 4850000, 960000, 150000, 200000, 90000, 20000, 60000
            ])
        ];
    }
}
