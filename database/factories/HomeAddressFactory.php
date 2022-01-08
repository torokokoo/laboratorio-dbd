<?php

namespace Database\Factories;

use App\Models\HomeAddress;
use App\Models\Comuna;
use Illuminate\Database\Eloquent\Factories\Factory;

class HomeAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->streetName(),
            'number' => $this->faker->buildingNumber(),
            'comuna_id' => Comuna::all()->random()->id
        ];
    }
}
