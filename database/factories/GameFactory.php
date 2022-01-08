<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Url;
use App\Models\Demo;
use App\Models\AgeRestriction;
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
            'storage' => $this->faker->randomFloat($nbMaxDecimals = 4, $min = 0, $max = NULL),
            'age_restriction_id' => AgeRestriction::all()->random()->id,
            'url_id' => Url::all()->random()->id,
            'demo_id' => Demo::all()->random()->id
        ];
    }
}
