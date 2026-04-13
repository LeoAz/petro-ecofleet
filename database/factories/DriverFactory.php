<?php

namespace Database\Factories;

use App\Enums\Fleet\DriverStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
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
            'name' => $this->faker->name,
            'matricule' => $this->faker->numerify('###########'),
            'birth_date' => $this->faker->dateTimeBetween('-40 years', '-25 years'),
            'address' => $this->faker->address,
            'driver_licence' => $this->faker->bothify('###?????#?#??'),
            'licence_category' => $this->faker->randomElement(['BC', 'BCE']),
            'salary' => $this->faker->randomElement([150000, 100000, 125000]),
            'exp_date' => $this->faker->dateTimeBetween('-2 months', '+3 years'),
            'tel' => $this->faker->phoneNumber,
            'observation' => $this->faker->sentence,
            'status' => DriverStatus::getRandomValue()
        ];
    }
}
