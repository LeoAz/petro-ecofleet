<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FuelOrderFactory extends Factory
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
            'place' => $this->faker->city,
            'code_order' => $this->faker->numerify('################'),
            'date_order' => $this->faker->dateTimeBetween('-6 months', '-7 days'),
            'quantity' => $this->faker->randomElement([
                100, 200, 250, 500, 450
            ]),
            'unit_price' => $this->faker->randomElement([
                530, 655, 475, 710, 590
            ]),
            'total_price' => $this->faker->randomElement([
                100000, 250000, 485000, 563000, 700000, 525000
            ])
        ];
    }
}
