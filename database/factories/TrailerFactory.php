<?php

namespace Database\Factories;

use App\Enums\Fleet\FleetState;
use App\Enums\Fleet\FleetUsage;
use App\Enums\Fleet\TrailerStatus;
use App\Enums\Fleet\TrailerType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrailerFactory extends Factory
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
            'registration' => $this->faker->unique()->bothify('?? #### ??'),
            'code_trailer' => $this->faker->unique()->numerify('??#####'),
            'empty_weight' => $this->faker->numberBetween(30, 60),
            'capacity' => $this->faker->randomElement([65000, 15000, 45000, 80000, 76000, 600000, 120000]),
            'unit' => $this->faker->randomElement([
                'Litres', 'Kilogrammes'
            ]),
            'commissioning_date' => $this->faker->dateTimeBetween('-3 years', '-6 months'),
            'acquisition_amount' => $this->faker->randomElement([6500000, 150000000, 45000000, 80000000, 7600000, 46000000, 12000000]),
            'status' => TrailerStatus::getRandomValue(),
            'state' => FleetState::getRandomValue(),
            'usage' => FleetUsage::getRandomValue(),
            'type' => TrailerType::getRandomValue(),
            'axels' => $this->faker->randomElement([3, 4]),
            'is_linked' => $this->faker->boolean
        ];
    }
}
