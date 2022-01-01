<?php

namespace Database\Factories;

use App\Models\CountryGame;
use App\Models\Country;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryGameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => Country::all()->random()->id,
            'game_id' => Game::all()->random()->id
        ];
    }
}
