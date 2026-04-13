<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_point' => $this->faker->city,
            'end_point' => $this->faker->city,
            'mileage' => $this->faker->numberBetween(500, 50000),
            'fuel_quantity' => $this->faker->numberBetween(250, 650),
            'duration' => $this->faker->numberBetween(2,5)
        ];
    }
}
