<?php

namespace Database\Factories;

use App\Models\GameGender;
use App\Models\Game;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameGenderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gender_id' => Gender::all()->random()->id,
            'game_id' => Game::all()->random()->id
        ];
    }
}
