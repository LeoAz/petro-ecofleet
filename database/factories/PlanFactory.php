<?php

namespace Database\Factories;

use App\Enums\Exploitation\PlanStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
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
            'code_plan' => $this->faker->numerify('#############'),
            'date_plan' => $this->faker->dateTimeBetween('-6 months', '-9 days')
        ];
    }
}
