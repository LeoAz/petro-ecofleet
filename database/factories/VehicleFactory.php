<?php

namespace Database\Factories;

use App\Enums\Fleet\FleetState;
use App\Enums\Fleet\FleetUsage;
use App\Enums\Fleet\VehicleStatus;
use App\Enums\Fleet\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class
VehicleFactory extends Factory
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
            'chassis' => $this->faker->unique()->bothify('??####'),
            'code_vehicle' => $this->faker->unique()->numerify('??####'),
            'fuel' => $this->faker->randomElement([
                'Diesel',
                'Gasoil',
                'Essence'
            ]),
            'power' => $this->faker->numberBetween(150, 300),
            'empty_weight' => $this->faker->numberBetween(30, 60),
            'capacity' => $this->faker->numberBetween(30, 50),
            'unit' => $this->faker->randomElement([
                'tonne',
                'litres',
                'kilogramme'
            ]),
            'consumption' => $this->faker->numberBetween(50, 70),
            'number_places' => $this->faker->numberBetween(1, 5),
            'mileage' => $this->faker->numberBetween(6500, 8000),
            'commissioning_date' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'acquisition_amount' => $this->faker->randomElement([6500000, 150000000, 45000000, 80000000, 7600000, 46000000, 12000000]),
            'has_driver' => $this->faker->boolean,
            'is_linked' => $this->faker->boolean,
            'status' => VehicleStatus::getRandomValue(),
            'type' => VehicleType::getRandomValue(),
            'state' => FleetState::getRandomValue(),
            'usage' => FleetUsage::getRandomValue()
        ];
    }
}
