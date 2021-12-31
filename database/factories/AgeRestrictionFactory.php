<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgeRestrictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'age_restriction' => $this->faker->numberBetween($min = 0, $max = 90)
        ];
    }
}
