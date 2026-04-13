<?php

namespace Database\Factories;

use App\Enums\Exploitation\TripStatus;
use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cities = Town::pluck('description');
        return [
            'uuid' => $this->faker->uuid,
            'date' => $this->faker->dateTimeBetween('-1 year', '-2 days'),
            'start_point' => $cities->random(),
            'end_point' => $cities->random(),
            'quantity' => $this->faker->randomElement([
                1000, 2000, 2500, 5000,
            ]),
            'unit' => $this->faker->randomElement([
                'tonne', 'litre'
            ]),
            'load_date' => $this->faker->dateTimeBetween('-3 months',  'now'),
            'delivery_date' => $this->faker->dateTimeBetween('-3 months',  'now'),
            'observation' => $this->faker->paragraph('2'),
            'status' => TripStatus::getRandomValue()
        ];
    }
}
