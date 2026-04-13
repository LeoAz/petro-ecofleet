<?php

namespace Database\Factories;

use App\Enums\Fleet\DocumentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
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
            'label' => $this->faker->word,
            'type' => $this->faker->randomElement(['Permis de conduire', 'Assurance', 'carte grise', 'carte de transport', 'autre documents']),
            'amount' => $this->faker->randomElement([150000, 100000, 125000]),
            'delivery_date' => $this->faker->dateTimeBetween('-10 months', '-1 months'),
            'exp_date' => $this->faker->dateTimeBetween('-2 months', '+1 years'),
            'provider' => $this->faker->company,
            'status' => DocumentStatus::getRandomValue()
        ];
    }
}
