<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
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
            'code_sale' => $this->faker->numerify('###########'),
            'date_sale' => $this->faker->dateTimeBetween('-3 months', '-10 days'),
            'unit_price' => $this->faker->randomElement([
                450, 560, 720, 650
            ]),
            'missing' => $this->faker->randomElement([
                450, 560, 720, 650
            ]),
            'unload_quantity' => $this->faker->randomElement([
                4500, 5600, 7200, 6500
            ]),
            'total_price' => $this->faker->randomElement([
                4500000, 5600000, 7200000, 6500000])
        ];
    }
}
