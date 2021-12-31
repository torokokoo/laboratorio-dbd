<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText($maxNbChars = 1000, $indexSize = 2),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = NULL),
            'sales' => $this->faker->numberBetween($min = 0, $max = NULL),
            'clasification' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'valoration' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'storage' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = NULL),
            
        ];
    }
}
